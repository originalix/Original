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