<?php

namespace Skill\Options;

use Skill\Skill;

class MagicShield extends Skill
{
    public bool $isForAttack = false;

    public function __construct()
    {
        $this->setName("Magic Shield");
        $this->setChance(50);
        $this->setValue(0.5);
    }
}