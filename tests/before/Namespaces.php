<?php

namespace namespaceA;

class classA {

}

namespace namespaceC\namespaceD;

class classD {

}

namespace namespaceB;

use namespaceA\classA as classC;
use namespaceC\namespaceD as namespaceDAlias;

class classB {

    private $_objectA;

    private $_objectB;

    public function __construct() {
        $this->_objectA = new classC();
        $this->_objectB = new namespaceDAlias\classD();
    }
}

