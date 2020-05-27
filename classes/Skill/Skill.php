<?php

namespace Skill;

use Helper\GeneralHelper;
use Skill\Interfaces\SkillInterface;

class Skill implements SkillInterface
{
    public string $name = "";
    public int $value = 0;
    public int $chance = 0;
    public bool $isForAttack = false;
    /**
     * @return int
     */
    public function getChance(): int
    {
        return $this->chance;
    }

    /**
     * @param int $value
     */
    public function setChance(int $value): void
    {
        $this->chance = $value;
    }

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue() : int
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isForAttack(): bool
    {
        return $this->isForAttack;
    }

    /**
     * @return bool
     */
    public function mayUseIt() : bool
    {
        return GeneralHelper::imLucky($this->chance);
    }
}