<?php

function inverse($x)
{
    if (!$x) {
        throw new Exception("Division by zero.");
    }

    return 1 / $x ;
}

try {
    echo inverse(5) . "\n";
    echo inverse(0) . "\n";
} catch (Exception $x) {
    echo "catch error", $x->getMessage(), "\n";
}

echo "Hello World \n";
