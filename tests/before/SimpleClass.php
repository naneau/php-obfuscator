<?php

class SimpleClass {

    private $_privateProperty;
    protected $_protectedProperty;
    public $publicProperty;

    private function _privateMethod() {
        $localVar = "test";
        $this->_privateProperty = $localVar;
        $this->_protectedProperty = $localVar;
        $this->publicProperty = $localVar;
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