<?php
/**
 * Scrambler.php
 *
 * @package         Obfuscator
 * @subpackage      NodeVisitor
 */

namespace Naneau\Obfuscator\Node\Visitor;

use Naneau\Obfuscator\StringScrambler;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

use \InvalidArgumentException;

/**
 * Scrambler
 *
 * Base class for scrambling visitors
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      NodeVisitor
 */
abstract class Scrambler extends NodeVisitorAbstract
{
    /**
     * The string scrambler
     *
     * @var StringScrambler
     **/
    private $scrambler;

    /**
     * Variables to ignore
     *
     * @var string
     **/
    private $ignore = array();

    /**
     * Constructor
     *
     * @param  StringScrambler $scrambler
     * @return void
     **/
    public function __construct(StringScrambler $scrambler)
    {
        $this->setScrambler($scrambler);
    }

    /**
     * Scramble a property of a node
     *
     * @param  Node   $node
     * @param  string $var  property to scramble
     * @return Node
     **/
    protected function scramble(Node $node, $var = 'name')
    {
        // String/value to scramble
        $toScramble = $node->$var;

        // Make sure there's something to scramble
        if (strlen($toScramble) === 0) {
            throw new InvalidArgumentException(sprintf(
                '"%s" value empty for node, can not scramble',
                $var
            ));
        }

        // Should we ignore it?
        if (in_array($toScramble, $this->getIgnore())) {
            return $node;
        }

        // Prefix with 'p' so we dont' start with an number
        $node->$var = $this->scrambleString($toScramble);

        // Return the node
        return $node;
    }

    /**
     * Scramble a string
     *
     * @param  string $string
     * @return string
     **/
    protected function scrambleString($string)
    {
        return 's' . $this->getScrambler()->scramble($string);
    }

    /**
     * Get the string scrambler
     *
     * @return StringScrambler
     */
    public function getScrambler()
    {
        return $this->scrambler;
    }

    /**
     * Set the string scrambler
     *
     * @param  StringScrambler $scrambler
     * @return RenameParameter
     */
    public function setScrambler(StringScrambler $scrambler)
    {
        $this->scrambler = $scrambler;

        return $this;
    }

    /**
     * Get variables to ignore
     *
     * @return string[]
     */
    public function getIgnore()
    {
        return $this->ignore;
    }

    /**
     * Set variables to ignore
     *
     * @param  string[] $ignore
     * @return parent
     */
    public function setIgnore(array $ignore)
    {
        $this->ignore = $ignore;

        return $this;
    }

    /**
     * Add a variable name to ignore
     *
     * @param  string|string[]        $ignore
     * @return RenameParameterVisitor
     **/
    public function addIgnore($ignore)
    {
        $this->ignore = array_merge($this->ignore, (array) $ignore);

        return $this;
    }
}
