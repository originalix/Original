<?php

$double = function($a)
{
    return $a * 2;
};

$numbers = range(1, 5);

$new_numbers = array_map($double, $numbers);

print implode(' ', $new_numbers);

?>