<?php

/**
  * PHPToolkit Polish VATID validator
  *
  * @author Tomasz Sobczak <tomeksobczak@gmail.com>
  **/
function ptkIsValidPlVatid($vatid)
{
    $MODULO_DIVISOR = 11;
    $VALID_LENGTH   = 10;
    $WEIGHTS        = array(6, 5, 7, 2, 3, 4, 5, 6, 7);

    $digits = array_filter(preg_split('//', $vatid, -1, PREG_SPLIT_NO_EMPTY), 'is_numeric');
    $length = count($digits);
    $sum    = 0;

    if ($VALID_LENGTH != $length) {
        return false;
    }

    foreach ($WEIGHTS as $weight) {
        $sum += $weight * array_shift($digits);
    }

    return (($sum % $MODULO_DIVISOR) == array_shift($digits));
}
