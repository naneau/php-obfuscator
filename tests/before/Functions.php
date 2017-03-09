<?php


function functionA($argumentVar) {
    $localVarA = 3;
    return $argumentVar + $localVarA;
}

function functionB() {
    $localVarB = 5;
    return functionB($localVarB);
}

$localVarMainA = "local value";
$localVarMainB = functionB();
$localVarMainA = functionA($localVarMainA);