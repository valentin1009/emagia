<?php

namespace Helper;

class GeneralHelper
{
    public static function getValueBetween($from = 0, $to = 0) : int
    {
        return rand($from, $to);
    }
}