<?php

namespace Player;

use Player\Interfaces\PlayerInterface;
use Skill\Skill;
use Stats\Options\Health;
use Stats\Stats;

/**
 * Class Player
 * @package Player
 */
class Player implements PlayerInterface
{
    public string $name;
    protected bool $isHero = false;
    protected $skills = [];
    protected $stats = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isHero(): bool
    {
        return (boolean)$this->isHero;
    }

    /**
     * @param int $isHero
     */
    protected function setIsHero(bool $isHero): void
    {
        $this->isHero = $isHero;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkill(Skill $skills): void
    {
        if ($this->isHero()) {
            $this->skills[] = $skills;
        }
    }

    /**
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param mixed $stats
     */
    public function setStat(Stats $stats): void
    {
        $this->stats[] = $stats;
    }

    /**
     * @param $className
     * @param int $value
     * @return mixed
     */
    public function setStatsValue($className, int $value)
    {
        if (!empty($this->getStats())) {
            foreach ($this->getStats() as $stat) {
                if ($stat instanceof $className) {
                    return $stat->setValue($value);
                }
            }
        }
    }

    /**
     * @param $className
     * @return bool
     */
    public function getStatsValue($className)
    {
        if (!empty($this->getStats())) {
            foreach ($this->getStats() as $stat) {
                if ($stat instanceof $className) {
                    return $stat->getValue();
                }
            }
        }

        return false;
    }

    /**
     * @param int $value
     * @return bool
     */
    public function substractDamage(int $value)
    {
        if (!empty($this->getStats())) {
            foreach ($this->getStats() as $stat) {
                if ($stat instanceof Health) {
                    $currentValue = $stat->getValue();
                    $stat->setValue($currentValue - $value);

                    break;
                }
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isAlive()
    {
        $currentHealth = $this->getStatsValue(Health::class);
        return $currentHealth >= 0;
    }
}