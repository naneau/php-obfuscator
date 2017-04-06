<?php


function functionA($argumentVar) {
    $localVarA = 3;
    return $argumentVar + $localVarA;
}

function functionB() {
    $localVarB = 5;
    return functionB($localVarB);
}

function functionC(?int $a): ?string {
    return $a === null ? null : "Output: " . $a;
}

$localVarMainA = "local value";
$localVarMainB = functionB();
$localVarMainA = functionA($localVarMainA);
functionC();