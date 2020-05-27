<?php

namespace Helper;

use Player\Hero\Orderus;
use Player\Monster\Generic;
use Player\Player;
use Stats\Options\Luck;
use Stats\Options\Speed;

class GameHelper
{
    /**
     * @param Orderus $hero
     * @param Generic $monster
     * @return Player
     */
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

    /**
     * @param int $firstPlayerValue
     * @param int $secondPlayerValue
     * @param string $sign
     * @param string|null $signRest
     * @param bool $reverse
     * @return string
     */
    public static function convertStatsToSign(int $firstPlayerValue, int $secondPlayerValue, string $sign, string $signRest = null, $reverse = false)
    {
        $firstPlayerPoints = max(ceil($firstPlayerValue / 10), 0);
        $secondPlayerPoints = max(ceil($secondPlayerValue / 10), 0);

        $output = [];
        foreach(["first", "second"] as $playerPartNumber) {
            $whichPlayerPointsName = $playerPartNumber . "PlayerPoints";
            $whichPlayerPoints = $$whichPlayerPointsName;

            $whichPlayerValueName = $playerPartNumber . "PlayerValue";
            $whichPlayerValue = $$whichPlayerValueName;

            $output[] = implode("",
                array_merge(
                    $whichPlayerPoints > 0 ? array_fill(0, $whichPlayerPoints - 1, $sign) : [],
                    $signRest ? array_fill($whichPlayerPoints, 9, $signRest) : [],
                )
            ) . "[$whichPlayerValue]";
        }

        if ($reverse) {
            $output = array_reverse($output);
        }

        return implode(" | ", $output);
    }

    /**
     * @param $attackerStrength
     * @param $defenderDefence
     * @return mixed
     */
    public static function calcAttackFormula($attackerStrength, $defenderDefence)
    {
        return $attackerStrength - $defenderDefence;
    }
}