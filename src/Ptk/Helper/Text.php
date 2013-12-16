<?php

namespace Ptk\Helper;

class Text
{
    private static $easy_chars = '2345679ACDEFGHJKMNPRSTUVWXYZ';
    private static $hard_chars = 'AbCdEfGhIjKlMnOpQrStUvWxYz0123456789aBcDeFgHiJkLmNoPqRsTuVwXyZ';

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
