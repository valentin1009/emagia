<?php

namespace Player\Monster;

use Player\Player;
use Stats\Options\Defence;
use Stats\Options\Health;
use Stats\Options\Luck;
use Stats\Options\Speed;
use Stats\Options\Strength;

class Generic extends Player
{
    public function __construct()
    {
        $this->setName("Oponent");

        $this->setStat(new Health(60, 90));
        $this->setStat(new Strength(60, 90));
        $this->setStat(new Defence(40, 60));
        $this->setStat(new Speed(40, 60));
        $this->setStat(new Luck(25, 40));
    }
}