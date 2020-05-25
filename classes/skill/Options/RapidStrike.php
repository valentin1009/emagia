<?php

namespace Skill\Options;
use Skill\Skill;

class RapidStrike extends Skill
{
    public bool $isForAttack = true;

    public function __construct()
    {
        $this->setChance(10);
        $this->setValue(2);
    }
}