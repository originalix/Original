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

查看文件权限的语句：

```bash
# 在终端输入:
ls -l xxx.xxx （xxx.xxx是文件名）
# 那么就会出现相类似的信息，主要都是这些：
-rw-rw-r--
```

一共有10位数
```bash
其中： 最前面那个 - 代表的是类型
中间那三个 rw- 代表的是所有者（user）
然后那三个 rw- 代表的是组群（group）
最后那三个 r-- 代表的是其他人（other）
然后我再解释一下后面那9位数：
r 表示文件可以被读（read）
w 表示文件可以被写（write）
x 表示文件可以被执行（如果它是程序的话）
- 表示相应的权限还没有被授予

现在该说说修改文件权限了
在终端输入：
chmod o w xxx.xxx
表示给其他人授予写xxx.xxx这个文件的权限
chmod go-rw xxx.xxx
表示删除xxx.xxx中组群和其他人的读和写的权限
```

```bash
其中：
　　u 代表所有者（user）
　　g 代表所有者所在的组群（group）
　　o 代表其他人，但不是u和g （other）
　　a 代表全部的人，也就是包括u，g和o
　　r 表示文件可以被读（read）
　　w 表示文件可以被写（write）
　　x 表示文件可以被执行（如果它是程序的话）
　　其中：rwx也可以用数字来代替
　　r ------------4
　　w -----------2
　　x ------------1
　　- ------------0
```

```bash
行动：
　　 表示添加权限
　　- 表示删除权限
　　= 表示使之成为唯一的权限
　　当大家都明白了上面的东西之后，那么我们常见的以下的一些权限就很容易都明白了：
　　-rw------- (600) 只有所有者才有读和写的权限
　　-rw-r--r-- (644) 只有所有者才有读和写的权限，组群和其他人只有读的权限
　　-rwx------ (700) 只有所有者才有读，写，执行的权限
　　-rwxr-xr-x (755) 只有所有者才有读，写，执行的权限，组群和其他人只有读和执行的权限
　　-rwx--x--x (711) 只有所有者才有读，写，执行的权限，组群和其他人只有执行的权限
　　-rw-rw-rw- (666) 每个人都有读写的权限
　　-rwxrwxrwx (777) 每个人都有读写和执行的权限
```

常用的权限修改命令:
- chgrp ：改变文件所属群组
- chown ：改变文件拥有者
- chmod ：改变文件的权限, SUID, SGID, SBIT等等的特性

改变权限, chmod

文件权限的改变使用的是chmod这个指令，但是，权限的设定方法有两种， 分别可以使用数字或者是符号来进行权限的变更。我们就来谈一谈：

数字类型改变文件权限

各权限的分数对照表如下：
r:4
w:2
x:1
每种身份(owner/group/others)各自的三个权限(r/w/x)分数是需要累加的，例如当权限为： [-rwxrwx---] 分数则是：
owner = rwx = 4+2+1 = 7
group = rwx = 4+2+1 = 7
others= --- = 0+0+0 = 0

在讲解清楚了这种权限分值的累加之后，再去体会自己当初敲入命令行中的数字，是不是恍然大悟了呢。不知道你们是不是，反正我是这样的。今天小小的知识点就记录到这里，下次有时间再更新咯。
