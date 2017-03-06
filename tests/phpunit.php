<?php

include __DIR__ . '/../vendor/autoload.php';

function autoLoader($className) {
    include __DIR__ . "\\..\\" . strtolower($className) . '.php';
}

spl_autoload_register('autoLoader');