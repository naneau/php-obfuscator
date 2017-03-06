<?php

namespace Tests;

use PhpParser\Parser;
use PhpParser\Lexer;
use PhpParser\NodeTraverser;
use PhpParser\PrettyPrinter\Standard as PrettyPrinter;
use Symfony;
use Naneau;
use Symfony\Component\Console\Tests;

class ObfuscateTest extends Base {

    protected function setUp() {
        mkdir("./tests/before");
    }

    protected function tearDown() {
        unlink("./tests/before/source.php");
        unlink("./tests/after/source.php");
        rmdir("./tests/before");
        rmdir("./tests/after");
    }

    /**
     * @param string $before
     * @param string $after
     * @dataProvider obfuscateProvider
     */
    public function testObfuscate($before, $after) {
        file_put_contents("./tests/before/source.php", $before);
        shell_exec("./bin/obfuscate obfuscate ./tests/before ./tests/after");
        $obfuscated = file_get_contents("./tests/after/source.php");
        $this->assertEquals($after, $obfuscated);
    }

    /**
     * @return array
     */
    public function obfuscateProvider() {
        return [
            [
'<?php

class a {
    private $vasya = "Pupkin";
    private function test() {
        echo "hi";
    }
}'
,
'<?php
class a { private $vasya = \'Pupkin\'; private function spdfcc8c() { echo \'hi\'; } }'
            ],
        ];
    }
}