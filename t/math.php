<?php

$a = '1.234';
$b = '5';

echo bcadd($a, $b);

echo bcadd($a, $b, 4);

function Add($Num1, $Num2, $Scale=null)
{
    // check if they're valid positive numbers, extract the whole numbers and decimals
    if(!preg_match("/^\+?(\d+)(\.\d+)?$/", $Num1, $Tmp1) ||
       !preg_match("/^\+?(\d+)(\.\d+)?$/", $Num2, $Tmp2))
        return('0');

}