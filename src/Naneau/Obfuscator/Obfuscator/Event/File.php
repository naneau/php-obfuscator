<?php
/**
 * File.php
 *
 * @package         Obfuscator
 * @subpackage      Obfuscator
 */

namespace Naneau\Obfuscator\Obfuscator\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * File
 *
 * A file is being obfuscated
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      Obfuscator
 */
class File extends Event
{
    /**
     * The file
     *
     * @var string
     **/
    private $file;

    /**
     * Constructor
     *
     * @param string $file
     * @return void
     **/
    public function __construct($file)
    {
        $this->setFile($file);
    }

    /**
     * Get the file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the file
     *
     * @param string $file
     * @return parent
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }
}
