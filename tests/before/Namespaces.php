<?php

namespace namespaceA;

class classA {

}

namespace namespaceC\namespaceD;

class classD {

}

interface interfaceA {

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

class classE extends namespaceDAlias\classD implements namespaceDAlias\interfaceA {

    public function method(namespaceDAlias\classD $objectD) {

    }
}