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
    const min_value = 0.1;
    const max_value = 9.9;

    public static function getMinValue()
    {
        return self::min_value;
    }

    public static function getMaxValue()
    {
        return self::max_value;
    }

    public static function toString()
    {
        echo '<br>min = ', self::getMinValue(), ' max = ', self::getMaxValue();
    }
}

Constants::toString();

include('call.php');
if (testDebug) {
    echo '<br>test debug false';
}

?>
