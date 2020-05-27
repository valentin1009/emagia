<?php

namespace Helper;

class GeneralHelper
{
    /**
     * @param int $from
     * @param int $to
     * @return int
     */
    public static function getValueBetween($from = 0, $to = 0) : int
    {
        return rand($from, $to);
    }

    /**
     * @param int $percentage
     * @return int
     */
    public static function imLucky(int $percentage) : int
    {
        return rand(0, 100) < $percentage;
    }
}