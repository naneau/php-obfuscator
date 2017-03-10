<?php

class FirstClass {

    protected $_protectedProperty;
    public $publicProperty;

    protected function _protectedMethod() {
        echo "This is protected method of first class";
    }

    public function publicMethod() {
        echo "This is public method of first class";
    }
}

class SecondClass extends FirstClass {

    private $_privateProperty;

    protected function _protectedMethod() {
        parent::_protectedMethod();
        echo "This is protected method of second class";
        $this->_privateProperty = parent::$_protectedProperty;
    }

    public function publicMethod() {
        parent::publicMethod();
        echo "This is public method of second class";
        $this->_privateProperty = parent::$publicProperty;
    }

    static public function anotherPublicMethod() {
    }
}

class ThirdClass {

    static private function anotherPublicMethod() {

    }

    public function __construct(SecondClass $secondObject) {
        $secondObject->publicMethod();
        $secondObject::anotherPublicMethod();
    }

    private function publicMethod() {
        echo 'test';
    }

    protected function someFunc() {
        $this->publicMethod();
        self::anotherPublicMethod();
    }
}