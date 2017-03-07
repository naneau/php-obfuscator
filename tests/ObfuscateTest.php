<?php

namespace Tests;

class ObfuscateTest extends Base {

    const AFTER_PATH    = "/after";
    const BEFORE_PATH   = "/before";
    const EXPECTED_PATH = "/expected";

    protected function tearDown() {
        $files = glob(__DIR__ . self::AFTER_PATH . "/*");
        foreach ($files as $file) {
            unlink($file);
        }
        rmdir(__DIR__ . self::AFTER_PATH);
    }

    public function testObfuscate() {
        shell_exec("./bin/obfuscate obfuscate " . __DIR__ . self::BEFORE_PATH . " " . __DIR__ . self::AFTER_PATH . " --config=" . __DIR__ . "/config.yml");
        $expectedFileNames = scandir(__DIR__ . self::EXPECTED_PATH);
        foreach ($expectedFileNames as $expectedFileName) {
            if ($expectedFileName === '.' || $expectedFileName === '..') {
                continue;
            }
            if (!file_exists(__DIR__ . self::EXPECTED_PATH . "/" . $expectedFileName)) {
                $this->fail("{$expectedFileName} not found");
            }
            $this->assertEquals(file_get_contents(__DIR__ . self::EXPECTED_PATH . "/" . $expectedFileName), file_get_contents(__DIR__ . self::AFTER_PATH . "/" . $expectedFileName));
        }
    }
}