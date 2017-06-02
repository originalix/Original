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

$A="5650175242.508133742";
$B="308437806.831153821478770";

printf("  Add(%s,%s);\r\n// %s\r\n\r\n",$A,$B,  Add($A,$B));
printf("BCAdd(%s,%s);\r\n// %s\r\n\r\n",$A,$B,BCAdd($A,$B));

/*
  This will produce the following..
    Add(5650175242.508133742,308437806.831153821478770);
  // 5958613049.33928756347877

  BCAdd(5650175242.508133742,308437806.831153821478770);
  // 5958613049
*/

$exp1 = "1E5";
$exp2 = "2E4";

$ans1 = bcadd((float)$exp1, (float)$exp2, 3);
$ans2 = bcadd((int)$exp1, (int)$exp2, 3);
$ans3 = bcadd($exp1, $exp2, 3);

echo "1: $exp1 + $exp2 = $ans1\r\n";
echo "2: $exp1 + $exp2 = $ans2\r\n";
echo "3: $exp1 + $exp2 = $ans3\r\n";

/*
1: 1E5 + 2E4 = 120000.000
2: 1E5 + 2E4 = 3.000
3: 1E5 + 2E4 = 0.000
 */

Liunx的文件权限

之前讲过为了统一开发环境生产环境以及更换开发机器的情况，我把环境统一由`Vagrant`部署在`Linux`的虚拟机中，但是由于我对`Linux`系统没有系统的学习过，对于环境的部署也仅仅通过谷歌等刚刚入门，所以在具体的开发中我还是经常在`Linux`中遇到问题，经常求教老大。看着老大熟练的把玩`Linux`，我也下定决心要把`Linux`掌握好。

经自己了解，《鸟哥的Linux私房菜》一书备受推崇，于是于半个月前购入，开始拜读学习。在日常的工作时间之外，断断续续的学习着，确实受益匪浅，厚厚的一本书现在才看了四分之一左右，决定还是抽出时间记录一下自己曾经对于`Linux`感到困惑的一些事情。

今天就来说说`Linux`中文件权限的一些门门道道。

当初我在部署第一个`Laravel`项目到阿里云的时候，在部署完成后，看到教程中要给`storage`文件设置权限，当时这个777 775等这种数字简直把我弄迷糊了。只能对照着命令乖乖的敲进去，神奇的是敲进去之后，果然问题解决了，站点能访问了。感觉甚是困惑。看完书中的文件权限一章之后，才发觉`Linux`中文件权限的神奇。