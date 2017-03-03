<?php
/**
 * Obfuscator.php
 *
 * @package         Obfuscator
 * @subpackage      Obfuscator
 */

namespace Naneau\Obfuscator;

use Naneau\Obfuscator\Obfuscator\Event\File as FileEvent;
use Naneau\Obfuscator\Obfuscator\Event\FileError as FileErrorEvent;

use PhpParser\NodeTraverserInterface as NodeTraverser;

use PhpParser\Parser;
use PhpParser\Lexer;
use PhpParser\PrettyPrinter\Standard as PrettyPrinter;

use Symfony\Component\EventDispatcher\EventDispatcher;

use \RegexIterator;
use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;
use \SplFileInfo;

use \Exception;

/**
 * Obfuscator
 *
 * Obfuscates a directory of files
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      Obfuscator
 */
class Obfuscator
{
    /**
     * the parser
     *
     * @var Parser
     */
    private $parser;

    /**
     * the node traverser
     *
     * @var NodeTraverser
     */
    private $traverser;

    /**
     * the "pretty" printer
     *
     * @var PrettyPrinter
     */
    private $prettyPrinter;

    /**
     * the event dispatcher
     *
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * The file regex
     *
     * @var string
     **/
    private $fileRegex = '/\.php$/';

    /**
     * Strip whitespace
     *
     * @param  string $directory
     * @param  bool   $stripWhitespace
     * @return void
     **/
    public function obfuscate($directory, $stripWhitespace = false,
        $ignoreError = false)
    {
        foreach ($this->getFiles($directory) as $file) {
            $this->getEventDispatcher()->dispatch(
                'obfuscator.file',
                new FileEvent($file)
            );

            // Write obfuscated source
            file_put_contents($file, $this->obfuscateFileContents($file,
                $ignoreError));

            // Strip whitespace if required
            if ($stripWhitespace) {
                file_put_contents($file, php_strip_whitespace($file));
            }
        }
    }

    /**
     * Get the parser
     *
     * @return Parser
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * Set the parser
     *
     * @param  Parser     $parser
     * @return Obfuscator
     */
    public function setParser(Parser $parser)
    {
        $this->parser = $parser;

        return $this;
    }

    /**
     * Get the node traverser
     *
     * @return NodeTraverser
     */
    public function getTraverser()
    {
        return $this->traverser;
    }

    /**
     * Set the node traverser
     *
     * @param  NodeTraverser $traverser
     * @return Obfuscator
     */
    public function setTraverser(NodeTraverser $traverser)
    {
        $this->traverser = $traverser;

        return $this;
    }

    /**
     * Get the "pretty" printer
     *
     * @return PrettyPrinter
     */
    public function getPrettyPrinter()
    {
        return $this->prettyPrinter;
    }

    /**
     * Set the "pretty" printer
     *
     * @param  PrettyPrinter $prettyPrinter
     * @return Obfuscator
     */
    public function setPrettyPrinter(PrettyPrinter $prettyPrinter)
    {
        $this->prettyPrinter = $prettyPrinter;

        return $this;
    }

    /**
     * Get the event dispatcher
     *
     * @return EventDispatcher
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * Set the event dispatcher
     *
     * @param EventDispatcher $eventDispatcher
     * @return Obfuscator
     */
    public function setEventDispatcher(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;

        return $this;
    }

    /**
     * Get the regex for file inclusion
     *
     * @return string
     */
    public function getFileRegex()
    {
        return $this->fileRegex;
    }

    /**
     * Set the regex for file inclusion
     *
     * @param string $fileRegex
     * @return Obfuscator
     */
    public function setFileRegex($fileRegex)
    {
        $this->fileRegex = $fileRegex;

        return $this;
    }

    /**
     * Get the file list
     *
     * @return SplFileInfo
     **/
    private function getFiles($directory)
    {
        return new RegexIterator(
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory)
            ),
            $this->getFileRegex()
        );
    }

    /**
     * Obfuscate a single file's contents
     *
     * @param  string $file
     * @param  boolean $ignoreError if true, do not throw an Error and 
     *                              exit, but continue with next file
     * @return string obfuscated contents
     **/
    private function obfuscateFileContents($file, $ignoreError)
    {
        try {
            // Input code
            $source = php_strip_whitespace($file);

            return $this->_obfuscateSource($source);
        } catch (Exception $e) {
            if($ignoreError) {
                sprintf('Could not parse file "%s"', $file);
                $this->getEventDispatcher()->dispatch(
                    'obfuscator.file.error',
                    new FileErrorEvent($file, $e->getMessage())
                );
            } else {
                throw new Exception(
                    sprintf('Could not parse file "%s"', $file),
                    null,
                    $e
                );
            }
        }
    }

    /**
     * @param string $sourceCode
     * @return string
     */
    protected function _obfuscateSource($sourceCode) {
        // Get AST
        $ast = $this->getTraverser()->traverse(
            $this->getParser()->parse($sourceCode)
        );

        return "<?php\n" . $this->getPrettyPrinter()->prettyPrint($ast);
    }
}
