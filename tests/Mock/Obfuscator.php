<?php
/**
 * @author Vyacheslav Gulyam <cheburon1@mail.ru>
 */

namespace Tests\Mock;

use Naneau;

class Obfuscator extends Naneau\Obfuscator\Obfuscator {

    /**
     * @param string $sourceCode
     * @return string
     */
    public function obfuscateSource($sourceCode) {
        return $this->_obfuscateSource($sourceCode);
    }
}