<?php

$context = hash_init("md5");
hash_update($context, "data");

$copy_context = hash_copy($context);

echo hash_final($context), "\n";

hash_update($copy_context, "data");

echo hash_final($copy_context);

$expected  = crypt('12345', '$2a$07$usesomesillystringforsalt$');
$correct   = crypt('12345', '$2a$07$usesomesillystringforsalt$');
$incorrect = crypt('apple', '$2a$07$usesomesillystringforsalt$');

var_dump(hash_equals($expected, $incorrect));
var_dump(hash_equals($expected, $correct));

file_put_contents('example.txt', 'The fuck');

echo hash_file('md5', 'example.txt');
