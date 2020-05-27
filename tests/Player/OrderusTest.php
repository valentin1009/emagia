<?php

namespace Player;

use PHPUnit\Framework\TestCase;
use Player\Hero\Orderus;
use Stats\Options\Defence;
use Stats\Options\Health;
use Stats\Options\Luck;
use Stats\Options\Speed;
use Stats\Options\Strength;

class OrderusTest extends TestCase
{
    protected Player $player;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->player = new Orderus();
        parent::__construct($name, $data, $dataName);
    }

    public function testIsHero()
    {
        $this->assertTrue($this->player->isHero());
    }

    public function testSkills()
    {
        $this->assertEquals(2, count($this->player->getSkills()));
    }

    public function testStats()
    {
        $this->assertThat(
            $this->player->getStatsValue(Health::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(70),
                $this->lessThanOrEqual(100)
            )
        );

        $this->assertThat(
            $this->player->getStatsValue(Strength::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(70),
                $this->lessThanOrEqual(80)
            )
        );

        $this->assertThat(
            $this->player->getStatsValue(Defence::class),
            $this->logicalAnd(
                $this->greaterThanOrEqual(45),
                $this->lessThanOrEqual(55)
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
                $this->greaterThanOrEqual(10),
                $this->lessThanOrEqual(30)
            )
        );
    }

    public function testDamage()
    {
        $damageProduced = 5;
        $currentHealth = $this->player->getStatsValue(Health::class);
        $this->player->substractDamage($damageProduced);

        $this->assertEquals($currentHealth - $damageProduced, $this->player->getStatsValue(Health::class));
    }
}
