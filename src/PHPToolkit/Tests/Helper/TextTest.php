<?php

require_once __DIR__ . '/../../Helper/Text.php';

/**
  * @author Tomasz Sobczak <tomeksobczak@gmail.com>
  **/
class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerPtkTextOrphans
     */
    public function testPtkTextOrphans($expected, $text, $message)
    {
        $this->assertEquals($expected, ptkTextOrphans($text), $message);
    }

    /**
     * @dataProvider providerPtkTextOrphansWithCustomSuffix
     */
    public function testPtkTextOrphansWithCustomSuffix($expected, $text, $suffix, $message)
    {
        $this->assertEquals($expected, ptkTextOrphans($text, $suffix), $message);
    }

    public function providerPtkTextOrphans()
    {
        $out = array();

        foreach (array_merge(array('a', 'i', 'o', 'u', 'w', 'z'), range(0, 9)) as $letter) {
            $out[] = array("Testing single {$letter}&nbsp;character", "Testing single {$letter} character", 'Testing single character to add suffix');
            $out[] = array("Testing double {$letter}{$letter} character", "Testing double {$letter}{$letter} character", 'Testing single character to skip suffix');
        }

        return $out;
    }

    public function providerPtkTextOrphansWithCustomSuffix()
    {
        $out = array();

        foreach (array_merge(array('a', 'i', 'o', 'u', 'w', 'z'), range(0, 9)) as $letter) {
            $out[] = array("Testing single {$letter}SUFFIXcharacter", "Testing single {$letter} character", 'SUFFIX', 'Testing single character to add suffix');
            $out[] = array("Testing double {$letter}{$letter} character", "Testing double {$letter}{$letter} character", 'SUFFIX', 'Testing single character to skip suffix');
        }

        return $out;
    }
}
