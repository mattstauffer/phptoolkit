<?php

namespace Tsbc\Ptk\Helper;

class Text
{
    private static $easy_chars = '2345679ACDEFGHJKMNPRSTUVWXYZ';
    private static $hard_chars = 'AbCdEfGhIjKlMnOpQrStUvWxYz0123456789aBcDeFgHiJkLmNoPqRsTuVwXyZ';

    public static function decodeInteger($input)
    {
        $out = 0;
        $len = strlen($input);
        $data = array_flip(str_split(self::$hard_chars));
        $base = strlen(self::$hard_chars);

        foreach (str_split($input) as $k => $v) {
            $out = $out + $data[$v] * pow($base, $len - ($k + 1));
        }

        return $out;
    }

    public static function encodeInteger($input)
    {
        $out = array();
        $data = self::$hard_chars;
        $base = strlen(self::$hard_chars);

        if (0 == $input) {
            $out[] = $data[$input];
        }

        while (0 < $input) {
            $rest = $input % $base;
            $input = (int) ($input / $base);
            $out[] = $data[$rest];
        }

        return implode(array_reverse($out));
    }

    public static function glueOrphans($input, $glue='&nbsp;')
    {
        return preg_replace('/\s([\dwuioaz]{1})\s/', ' \1' . $glue, $input);
    }

    public static function random($length=40, $easy=false)
    {
        $chars = ($easy) ? self::$easy_chars : self::$hard_chars;
        $value = '';
        $slen = strlen($chars) - 1;

        while (strlen($value) < $length) {
            $value .= $chars[mt_rand(0, $slen)];
        }

        return $value;
    }

    public static function truncate($input, $limit, $full_words=true, $trailing='...')
    {
        if(mb_strlen($input, 'UTF-8') <= $limit) {
            return $input;
        }

        $out = mb_substr($input, 0, $limit, 'UTF-8');

        if($full_words && $end = mb_strrpos($out, ' ', 0, 'UTF-8')) {
            $out = mb_substr($out, 0, $end, 'UTF-8');
        }

        return $out . $trailing;
    }
}
