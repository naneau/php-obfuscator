<?php
/**
 * SkipTrait.php
 *
 * @package         Obfuscator
 * @subpackage      NodeVisitor
 */

namespace Naneau\Obfuscator\Node\Visitor;

/**
 * SkipTrait
 *
 * Skipping certain classes trait
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      NodeVisitor
 */
trait SkipTrait
{
    /**
     * Skip processing?
     *
     * @var bool
     **/
    private $skip = false;

    /**
     * Should we skip processing?
     *
     * @param  bool                  $skip
     * @return ScramblePrivateMethod
     **/
    protected function skip($skip = false)
    {
        $this->skip = $skip;

        return $this;
    }

    /**
     * Should we skip processing?
     *
     * @return bool
     **/
    protected function shouldSkip()
    {
        return $this->skip;
    }
}
