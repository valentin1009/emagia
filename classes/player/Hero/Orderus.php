<?php

namespace Player\Hero;

use Player\Player;
use Skill\Options\MagicShield;
use Skill\Options\RapidStrike;
use Stats\Options\Defence;
use Stats\Options\Health;
use Stats\Options\Luck;
use Stats\Options\Speed;
use Stats\Options\Strength;

class Orderus extends Player
{
    public function __construct()
    {
        $this->setName("Orderus");
        $this->setIsHero(true);

        $this->setStat(new Health(70, 100));
        $this->setStat(new Strength(70, 80));
        $this->setStat(new Defence(45, 55));
        $this->setStat(new Speed(40, 50));
        $this->setStat(new Luck(10, 30));

        $this->setSkill(new MagicShield());
        $this->setSkill(new RapidStrike());
    }
}