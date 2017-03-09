<?php

namespace namespaceA;

class classA {

}

namespace namespaceB;

use namespaceA\classA as classC;

class classB {

    private $_objectA;

    public function __construct() {
        $this->_objectA = new classC();
    }
}