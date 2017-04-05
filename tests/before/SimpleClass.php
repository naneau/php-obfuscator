<?php

class SimpleClass {

    const CONSTANT_VARIABLE = "test";

    public static $publicStaticProperty = "test";
    protected static $protectedStaticProperty = "test";
    private static  $_privateStaticProperty = "test";


    private $_privateProperty;
    protected $_protectedProperty;
    public $publicProperty;

    private function _privateMethod() {
        $localVar = "test";
        $this->_privateProperty = $localVar;
        $this->_protectedProperty = $localVar;
        $this->publicProperty = $localVar;
        self::$publicStaticProperty = "test";
        self::$protectedStaticProperty = "test";
        self::$_privateStaticProperty = "test";
    }

    protected function _protectedMethod() {
        $localVar = "test";
        $this->_privateProperty = $localVar;
        $this->_protectedProperty = $localVar;
        $this->publicProperty = $localVar;
    }

    public function publicMethod() {
        $localVar = "test";
        $this->_privateProperty = $localVar;
        $this->_protectedProperty = $localVar;
        $this->publicProperty = $localVar;
        $this->_protectedMethod();
        $this->_privateMethod();
    }
}

$simpleObject = new SimpleClass();
$simpleObject->publicMethod();