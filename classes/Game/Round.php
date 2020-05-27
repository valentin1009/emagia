<?php

namespace Game;

use Player\Player;

class Round
{
    const MAX_ROUND_NBR = 20;

    protected $_currentRound = 1;
    public Player $attacker;
    public Player $defender;

    /**
     *
     */
    public function nextRound()
    {
        $this->_currentRound++;
        $this->switchRoles();
    }

    /**
     * @return bool
     */
    public function areRoundsLeft()
    {
        return $this->_currentRound <= self::MAX_ROUND_NBR;
    }

    /**
     *
     */
    public function switchRoles()
    {
        $tmpAttacker = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $tmpAttacker;
    }

    /**
     * @return int
     */
    public function getCurrentRound(): int
    {
        return $this->_currentRound;
    }

    /**
     * @param int $currentRound
     */
    public function setCurrentRound(int $currentRound): void
    {
        $this->_currentRound = $currentRound;
    }
}