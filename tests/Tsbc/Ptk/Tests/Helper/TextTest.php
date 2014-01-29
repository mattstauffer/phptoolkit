<?php

use Tsbc\Ptk\Helper\Text as Text;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerDecodeInteger
     */
    public function testDecodeIntiger($expected, $input, $message)
    {
        $this->assertEquals($expected, Text::decodeInteger($input), $message);
    }

    /**
     * @dataProvider providerEncodeInteger
     */
    public function testEncodeIntiger($expected, $integer, $message)
    {
        $this->assertEquals($expected, Text::encodeInteger($integer), $message);
    }

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

    /**
     * @dataProvider providerRandom
     */
    public function testRandom($expected, $length, $easy_chars, $message)
    {
        $this->assertRegExp($expected, Text::random($length, $easy_chars), $message);
    }

    /**
     * @dataProvider providerTruncate
     */
    public function testTruncate($expected, $text, $limit, $full_words, $trailing, $message)
    {
        $this->assertEquals($expected, Text::truncate($text, $limit, $full_words, $trailing), $message);
    }

    public function providerDecodeInteger()
    {
        $out = array(
            array(26, 0, 'Testing integer decoding to text'),
            array(1, 'b', 'Testing integer decoding to text'),
            array(42, 'g', 'Testing integer decoding to text'),
            array(654, 'K8', 'Testing integer decoding to text'),
            array(3214, 'Pq', 'Testing integer decoding to text'),
            array(76545, 'tuB', 'Testing integer decoding to text'),
            array(924255, 'ds1v','Testing integer decoding to text')
        );

        return $out;
    }

    public function providerEncodeInteger()
    {
        $out = array(
            array('A', 0, 'Testing integer encoding to text'),
            array('b', 1, 'Testing integer encoding to text'),
            array('bA', 62, 'Testing integer encoding to text'),
            array('CE', 128, 'Testing integer encoding to text'),
            array('Pq', 3214, 'Testing integer encoding to text'),
            array('tuB', 76545, 'Testing integer encoding to text'),
            array('ds1v', 924255, 'Testing integer encoding to text')
        );

        return $out;
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

    public function providerRandom()
    {
        $tmp = array(rand(1, 100), rand(1, 100));
        $out = array(
            array('/^[2345679ACDEFGHJKMNPRSTUVWXYZ]{' . $tmp[0] . '}$/', $tmp[0], true, 'Testing randomstring with easy chars'),
            array('/^[AbCdEfGhIjKlMnOpQrStUvWxYz0123456789aBcDeFgHiJkLmNoPqRsTuVwXyZ]{' . $tmp[1] . '}$/', $tmp[1], true, 'Testing randomstring with hard chars'),
        );
    
        return $out;
    }

    public function providerTruncate()
    {
        $out = array(
            array('Testing...', 'Testing simple truncate with full words', 10, true, '...', 'Testing simple truncate with full words'),
            array('Testing si...', 'Testing simple truncate with truncated words', 10, false, '...', 'Testing simple truncate with truncated words'),
            array('Testing[more]', 'Testing simple truncate with custom suffix', 10, true, '[more]', 'Testing simple truncate with custom suffix'),
            array('Testing UTF truncate ąćęłńóżź...', 'Testing UTF truncate ąćęłńóżź and thats end', 30, true, '...', 'Testing UTF truncate ąćęłńóżź and thats end')
        );
    
        return $out;
    }
}
