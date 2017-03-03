<?php

namespace Tests;

use PhpParser\Parser;
use PhpParser\Lexer;
use PhpParser\NodeTraverser;
use PhpParser\PrettyPrinter\Standard as PrettyPrinter;

class ObfuscateTest extends Base {

    public function testObfuscate() {
        $source = '<?php
            class a {
                private $vasya = "Pupkin";
                private function test() {
                echo "hi";
            }
            }';
        $obfuscator = new Mock\Obfuscator();
        $obfuscator->setParser(new Parser(new Lexer()));
        $obfuscator->setTraverser(new NodeTraverser());
        $obfuscator->setPrettyPrinter(new PrettyPrinter());
        echo $obfuscator->obfuscateSource($source);
    }

}