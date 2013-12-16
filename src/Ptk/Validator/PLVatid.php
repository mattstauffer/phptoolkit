<?php

namespace Ptk\Validator;

class PLVatid
{
    private static $modulo_divisor = 11;
    private static $valid_length = 10;
    private static $weights = array(6, 5, 7, 2, 3, 4, 5, 6, 7);

    public static function isValid($vatid)
    {
        $digits = array_filter(preg_split('//', $vatid, -1, PREG_SPLIT_NO_EMPTY), 'is_numeric');
        $length = count($digits);
        $sum = 0;

        if (self::$valid_length != $length) {
            return false;
        }

        foreach (self::$weights as $weight) {
            $sum += $weight * array_shift($digits);
        }

        return (($sum % self::$modulo_divisor) == array_shift($digits));
    }
}
