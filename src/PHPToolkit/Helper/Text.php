<?php

/**
  * PHPToolkit Polish VATID validator
  *
  * @author Tomasz Sobczak <tomeksobczak@gmail.com>
  **/
function ptkTextOrphans($input, $suffix = '&nbsp;')
{
    return preg_replace('/\s([\dwuioaz]{1})\s/', ' \1' . $suffix, $input);
}
