<?php
namespace namespaceA; class classA { } namespace namespaceC\namespaceD; class classD { } namespace namespaceB; use namespaceA\classA as spf0f507; use namespaceC\namespaceD as sp63627e; class classB { private $spa26210; private $sp2e1034; public function __construct() { $this->spa26210 = new spf0f507(); $this->sp2e1034 = new sp63627e\classD(); } }