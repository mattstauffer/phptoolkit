<?php

require_once __DIR__ . '/../../Helper/Text.php';

use Ptk\Helper\Text as Text;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerGlueOrphans
     */
    public function testGlueOrphans($expected, $text, $message)
    {
        $this->assertEquals($expected, Text::glueOrphans($text), $message);
    }

    /**
     * @dataProvider providerGlueOrphansWithCustomSuffix
     */
    public function testGlueOrphansWithCustomSuffix($expected, $text, $suffix, $message)
    {
        $this->assertEquals($expected, Text::glueOrphans($text, $suffix), $message);
    }

    public function providerGlueOrphans()
    {
        $out = array();

        foreach (array_merge(array('a', 'i', 'o', 'u', 'w', 'z'), range(0, 9)) as $letter) {
            $out[] = array("Testing single {$letter}&nbsp;character", "Testing single {$letter} character", 'Testing single character to add suffix');
            $out[] = array("Testing double {$letter}{$letter} character", "Testing double {$letter}{$letter} character", 'Testing single character to skip suffix');
        }

        return $out;
    }

    public function providerGlueOrphansWithCustomSuffix()
    {
        $out = array();

        foreach (array_merge(array('a', 'i', 'o', 'u', 'w', 'z'), range(0, 9)) as $letter) {
            $out[] = array("Testing single {$letter}SUFFIXcharacter", "Testing single {$letter} character", 'SUFFIX', 'Testing single character to add suffix');
            $out[] = array("Testing double {$letter}{$letter} character", "Testing double {$letter}{$letter} character", 'SUFFIX', 'Testing single character to skip suffix');
        }

        return $out;
    }
}
