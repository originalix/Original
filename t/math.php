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

    // this is where the result is stored
    $Output = array();

    // remove ending zeroes from decimals and remove point
    $Dec1=isset($Tmp1[2])?rtrim(substr($Tmp1[2],1),'0'):'';
    $Dec2=isset($Tmp2[2])?rtrim(substr($Tmp2[2],1),'0'):'';

}