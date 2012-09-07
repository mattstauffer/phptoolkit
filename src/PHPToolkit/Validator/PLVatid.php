<?php

namespace PHPToolkit\Validator;

/**
  * @author Tomasz Sobczak <tomeksobczak@gmail.com>
  **/
class PLVatid
{
    const MODULO_DIVISOR     = 11;
    const VATID_VALID_LENGTH = 10;

    private $vatid = null;

    public function __construct($vatid)
    {
        $this->vatid = $vatid;
    }

    public function isValid($vatid = null)
    {
        if (is_null($vatid)) {
            $vatid = $this->vatid;
        }

        $digits = array_filter(preg_split('//', $vatid, -1, PREG_SPLIT_NO_EMPTY), 'is_numeric');
        $length = count($digits);
        $sum    = 0;

        if (self::VATID_VALID_LENGTH != $length) {
            return false;
        }

        foreach ($this->weights() as $weight) {
            $sum += $weight * array_shift($digits);
        }

        return (($sum % self::MODULO_DIVISOR) == array_shift($digits));
    }    

    private function weights()
    {
        return array(6, 5, 7, 2, 3, 4, 5, 6, 7);
    }
}
