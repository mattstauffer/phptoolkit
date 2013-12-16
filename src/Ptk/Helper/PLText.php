<?php

namespace Ptk\Helper;

class PLText
{
    public static function pluralize($amount, $single, $few, $many=null)
    {
        if (1 == $amount) {
            return $single;
        }

        $couple = (int) substr($amount, -1);
        $rest = $amount % 100;

        if (($couple > 1 && $couple < 5) &! ($rest > 10 && $rest < 20)) {
            return $few;
        }

        return (is_null($many)) ? $few : $many;
    }
}
