<?php

namespace Game;

use Helper\GameHelper;
use PHPUnit\Framework\TestCase;
use Game\Round;
use Player\Hero\Orderus;
use Player\Monster\Generic;
use Stats\Options\Luck;
use Stats\Options\Speed;

class RoundTest extends TestCase
{
    protected $round;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->round = new Round();
        $this->round->attacker = new Orderus();
        $this->round->defender = new Generic();

        parent::__construct($name, $data, $dataName);
    }

    public function testAreRoundsLeft()
    {
        $this->round->setCurrentRound(19);
        $this->assertTrue($this->round->areRoundsLeft());

        $this->round->nextRound();
        $this->assertInstanceOf(Orderus::class, $this->round->defender);
        $this->assertInstanceOf(Generic::class, $this->round->attacker);

        $this->assertTrue($this->round->areRoundsLeft());

        $this->round->nextRound();
        $this->assertInstanceOf(Generic::class, $this->round->defender);
        $this->assertInstanceOf(Orderus::class, $this->round->attacker);

        $this->assertFalse($this->round->areRoundsLeft());
    }

    public function testWhoIsFirst()
    {
        $this->round->attacker->setStatsValue(Speed::class, 10);
        $this->round->defender->setStatsValue(Speed::class, 10);

        $this->round->attacker->setStatsValue(Luck::class, 11);
        $this->round->defender->setStatsValue(Luck::class, 10);

        $this->assertInstanceOf(Orderus::class, GameHelper::whoIsFirst($this->round->attacker, $this->round->defender));
    }
}
