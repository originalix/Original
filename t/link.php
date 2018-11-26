<?php

// $a = 1;
// $b = 2;
// echo $a, $b;
// unset($a);
// echo $a, $b;
//
$_POST['A'] = 'B';
$nonReferencedPostVar = $_POST;
$nonReferencedPostVar['A'] = 'C';
echo 'POST: '.$_POST['A'].', Variable: '.$nonReferencedPostVar['A']."\n\n";

// Testing Globals
$GLOBALS['A'] = 'B';

$nonReferencedGlobalsVar = $GLOBALS;
$nonReferencedGlobalsVar['A'] = 'C';

echo 'GLOBALS: '.$GLOBALS['A'].', Variable: '.$nonReferencedGlobalsVar['A']."\n\n";

function a_test($str)
{
    echo "\nHi: $str";
    var_dump(debug_backtrace());
}

echo "<br>";

a_test('friend');

echo "<br>";

function a()
{
    b();
    echo "<br>";
}

function b()
{
    c();
    echo "<br>";
}

function c()
{
    debug_print_backtrace();
    echo '\n';
}

a();

echo "<br>";

print_r(error_get_last());

echo "<br>";

print_r(hash_algos());
