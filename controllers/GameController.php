<?php

namespace Controllers;

use Game\Round;
use Helper\GameHelper;
use Player\Hero\Orderus;
use Player\Monster\Generic;
use Stats\Options\Strength;

class GameController
{
    private $round;
    private $hero;
    private $monster;

    private bool $isInGame = true;

    public function __construct()
    {
        $this->_start();
        $this->_play();
    }

    protected function _start()
    {
        $this->hero = new Orderus();
        $this->monster = new Generic();

        $whoIsFirst = GameHelper::whoIsFirst($this->hero, $this->monster);

        $this->round = new Round();
        $this->round->attacker = $whoIsFirst;
        $this->round->defender = ($whoIsFirst instanceof Orderus) ? $this->monster : $this->hero;
    }

    protected function _play()
    {
        while ($this->isInGame)
        {
            $damageProduced = $this->round->attacker->getStatsValue(Strength::class);

            $damageMultiplier = 1;
            if (!empty($this->round->attacker->getSkills())) {
                foreach ($this->round->attacker->getSkills() as $skill)
                {
                    if ($skill->isForAttack) {
                        $damageMultiplier *= $skill->getValue();
                    }
                }
            }

            if (!empty($this->round->defender->getSkills())) {
                foreach ($this->round->defender->getSkills() as $skill)
                {
                    if (!$skill->isForAttack) {
                        $damageMultiplier *= $skill->getValue();
                    }
                }
            }

            $damageProduced *= $damageMultiplier;
        }
    }
}