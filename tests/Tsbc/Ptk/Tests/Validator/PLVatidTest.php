<?php

use Tsbc\Ptk\Validator\PLVatid as PLVatid;

class PLVatidTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerPLVatid
     */
    public function testIsValid($expected, $vatid, $message)
    {
        $this->assertEquals($expected, PLVatid::isValid($vatid), $message);
    }

    public function providerPLVatid()
    {
        return array(
            array(false, '123465789', 'Too short'),
            array(false, '12345678901', 'Too long'),
            array(false, '1234567890', 'Invalid control sum'),
            array(false, 'ABC1234567', 'Too short due to letters'),
            array(false, '5250008199', 'Invalid VATID'), // Narodowy Bank Polski with changed control sum (8 -> 9)
            array(true, '5250008198', 'Valid VATID'), // Narodowy Bank Polski
            array(true, '525-00-08-198', 'Valid VATID with dashes'), // Narodowy Bank Polski
            array(true, 'PL5250008198', 'Valid VATID with EU prefix'), // Narodowy Bank Polski
            array(true, 'PL525-00-08-198', 'Valid VATID with EU prefix and dashes') // Narodowy Bank Polski
        );
    }
}
