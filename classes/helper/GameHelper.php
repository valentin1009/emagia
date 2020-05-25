<?php

namespace Helper;

use Player\Hero\Orderus;
use Player\Monster\Generic;
use Player\Player;
use Stats\Options\Luck;
use Stats\Options\Speed;

class GameHelper
{
    public static function whoIsFirst(Orderus $hero, Generic $monster) : Player
    {
        $heroSpeed = $hero->getStatsValue(Speed::class);
        $monsterSpeed = $monster->getStatsValue(Speed::class);

        if ($heroSpeed != $monsterSpeed) {
            return $heroSpeed > $monsterSpeed ? $hero : $monster;
        }

        $heroLuck = $hero->getStatsValue(Luck::class);
        $monsterLuck = $monster->getStatsValue(Luck::class);

        return $heroLuck > $monsterLuck ? $hero : $monster;
    }
}