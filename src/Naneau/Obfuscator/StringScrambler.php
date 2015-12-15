<?php
/**
 * StringScrambler.php
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      Scrambler
 */

namespace Naneau\Obfuscator;

/**
 * StringScrambler
 *
 * Scrambles strings
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      Scrambler
 */
class StringScrambler
{
    /**
     * Salt
     *
     * @return void
     **/
    private $salt;

    /**
     * Constructor
     *
     * @param  string $salt optional salt, when left empty (null) semi-random value will be generated
     * @return void
     **/
    public function __construct($salt = null)
    {
        if ($salt === null) {
            $this->setSalt(
                md5(microtime(true) . rand(0,1))
            );
        } else { 
            $this->setSalt($salt); 
        }
    }

    /**
     * Scramble a string
     *
     * @param  string $string
     * @return string
     **/
    public function scramble($string)
    {
        return 'p' . substr(md5($string . $this->getSalt()), 0, 6);
    }

    /**
     * Get the salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the salt
     *
     * @param  string          $salt
     * @return StringScrambler
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
}
