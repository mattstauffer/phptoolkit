<?php

namespace Ptk\Helper;

class Text
{
    public static function glueOrphans($input, $glue='&nbsp;')
    {
        return preg_replace('/\s([\dwuioaz]{1})\s/', ' \1' . $glue, $input);
    }
}
