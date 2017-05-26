<?php

function gen_one_to_three() {
    for ($i = 1; $i <= 3; $i++) {
        //注意变量$i的值在不同的yield之间是保持传递的。
        yield $i;
    }
}

$generator = gen_one_to_three();
foreach ($generator as $value) {
    echo "$value\n";
}

/*
 * 下面每一行是用分号分割的字段组合，第一个字段将被用作键名。
 */

$input = <<<'EOF'
1;PHP;Likes dollar signs
2;Python;Likes whitespace
3;Ruby;Likes blocks
EOF;

function input_parser($input) {
    foreach (explode("\n", $input) as $line) {
        $fields = explode(';', $line);
        $id = array_shift($fields);

        yield $id => $fields;
    }
}

foreach (input_parser($input) as $id => $fields) {
    echo "$id:\n";

    echo "    $fields[0]\n";
    echo "    $fields[1]\n";
}

function gen_three_nulls() {
    foreach (range(1, 3) as $i) {
        yield;
    }
}

var_dump(iterator_to_array(gen_three_nulls()));

//使用引用来生成值

function &gen_reference() {
    $value = 3;

    while ($value > 0) {
        yield $value;
    }
}

/*
 * 我们可以在循环中修改$number的值，而生成器是使用的引用值来生成，所以gen_reference()内部的$value值也会跟着变化。
 */
foreach (gen_reference() as &$number) {
    echo (--$number).'... ';
}

