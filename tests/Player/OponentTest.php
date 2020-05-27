<?php

namespace Player;

use PHPUnit\Framework\TestCase;
use Player\Hero\Orderus;
use Player\Monster\Generic;
use Stats\Options\Defence;
use Stats\Options\Health;
use Stats\Options\Luck;
use Stats\Options\Speed;
use Stats\Options\Strength;

class OponentTest extends TestCase
{
    protected Player $player;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->player = new Generic();
        parent::__construct($name, $data, $dataName);
    }

    public function testIsHero()
    {
        $this->assertFalse($this->player->isHero());
    }

    public function testSkills()
    {
        $this->assertEquals(0, count($this->player->getSkills()));
    }

    public function testStats()
    {
        $this->assertThat(
            $this->player->getStatsValue(Health::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(60),
                $this->lessThanOrEqual(90)
            )
        );

        $this->assertThat(
            $this->player->getStatsValue(Strength::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(60),
                $this->lessThanOrEqual(90)
            )
        );

        $this->assertThat(
            $this->player->getStatsValue(Defence::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(40),
                $this->lessThanOrEqual(60)
            )
        );

        $this->assertThat(
            $this->player->getStatsValue(Speed::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(40),
                $this->lessThanOrEqual(50)
            )
        );

        $this->assertThat(
            $this->player->getStatsValue(Luck::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(25),
                $this->lessThanOrEqual(40)
            )
        );
    }
}
