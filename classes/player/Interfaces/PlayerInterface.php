<?php

namespace Player\Interfaces;
use Skill\Skill;
use Stats\Stats;

interface PlayerInterface
{
    public function setName(string $name);

    public function setStat(Stats $stats);

    public function setSkill(Skill $skills);

    public function isHero();

    public function getName();

    public function getStats();

    public function getSkills();
}