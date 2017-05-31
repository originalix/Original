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
    // calculate the longest length of decimals
    $DLen=max(strlen($Dec1),strlen($Dec2));

    // if $Scale is null, automatically set it to the amount of decimal places for accuracy
    if($Scale==null) $Scale=$DLen;

    // remove leading zeroes and reverse the whole numbers, then append padded decimals on the end
    $Num1=strrev(ltrim($Tmp1[1],'0').str_pad($Dec1,$DLen,'0'));
    $Num2=strrev(ltrim($Tmp2[1],'0').str_pad($Dec2,$DLen,'0'));

    // calculate the longest length we need to process
    $MLen=max(strlen($Num1),strlen($Num2));

    // pad the two numbers so they are of equal length (both equal to $MLen)
    $Num1=str_pad($Num1,$MLen,'0');
    $Num2=str_pad($Num2,$MLen,'0');

    // process each digit, keep the ones, carry the tens (remainders)
    for($i=0;$i<$MLen;$i++) {
        $Sum=((int)$Num1{$i}+(int)$Num2{$i});
        if(isset($Output[$i])) $Sum+=$Output[$i];
        $Output[$i]=$Sum%10;
        if($Sum>9) $Output[$i+1]=1;
    }

    // convert the array to string and reverse it
    $Output=strrev(implode($Output));

    // substring the decimal digits from the result, pad if necessary (if $Scale > amount of actual decimals)
    // next, since actual zero values can cause a problem with the substring values,ifso, just simply give '0'
    // next, append the decimal value, if $Scale is defined, and return result
    $Decimal=str_pad(substr($Output,-$DLen,$Scale),$Scale,'0');
    $Output=(($MLen-$DLen<1)?'0':substr($Output,0,-$DLen));
    $Output.=(($Scale>0)?".{$Decimal}":'');
    return($Output);
}