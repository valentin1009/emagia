<?php

namespace Game;

use Player\Player;

class Round
{
    const MAX_ROUND_NBR = 20;

    public $currentRound = 1;
    public Player $attacker;
    public Player $defender;

    public function nextRound()
    {
        $this->currentRound++;
        $this->switchRoles();
    }

    public function areRoundsLeft()
    {
        return $this->currentRound <= self::MAX_ROUND_NBR;
    }

    public function switchRoles()
    {
        $tmpAttacker = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $tmpAttacker;
    }
}