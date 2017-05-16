<?php

$double = function($a)
{
    return $a * 2;
};

$numbers = range(1, 5);

$new_numbers = array_map($double, $numbers);

print implode(' ', $new_numbers);

define('MIN_VALUE', '0.0');
define('MAX_VALUE', '10.0');

echo(' '. MIN_VALUE . ' ' . MAX_VALUE);

class Constants
{
    public static function getMinValue()
    {
        return MIN_VALUE;
    }

    public static function getMaxValue()
    {
        return MAX_VALUE;
    }

    public static function toString()
    {
        echo '<br>min = ', self::getMinValue(), ' max = ', self::getMaxValue();
    }
}

Constants::toString();

?>