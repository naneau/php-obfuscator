<?php
namespace namespaceA; class classA { } namespace namespaceB; use namespaceA; class classB { private $_objectA; public function __construct() { $this->_objectA = new namespaceA\classA(); } }