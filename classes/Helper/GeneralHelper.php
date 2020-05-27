<?php

namespace Helper;

class GeneralHelper
{
    public static function getValueBetween($from = 0, $to = 0) : int
    {
        return rand($from, $to);
    }

    public static function imLucky(int $percentage) : int
    {
        return rand(0, 100) < $percentage;
    }
}