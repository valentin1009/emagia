<?php

namespace Skill\Interfaces;

interface SkillInterface
{
    public function setName(string $name);

    public function setValue(int $value);

    public function setChance(int $value);

    public function getName();

    public function getValue();

    public function getChance();
}