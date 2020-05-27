<?php

namespace Controllers;

use Game\Output;
use Game\Round;
use Helper\GameHelper;
use Player\Hero\Orderus;
use Player\Monster\Generic;
use Player\Player;
use Stats\Options\Defence;
use Stats\Options\Health;
use Stats\Options\Strength;

class GameController
{
    private Round $round;
    private Player $hero;
    private Player $monster;
    private Output $output;

    private bool $isInGame = true;

    public function __construct()
    {
        $this->output = new Output();

        $this->_start();
        $this->_play();
        $this->output->displayAll();
    }

    protected function _start()
    {
        $this->output->addMsg("Prepare for battle");


        $this->hero = new Orderus();
        $this->monster = new Generic();

        $this->output->addMsg("Game Started");

        $whoIsFirst = GameHelper::whoIsFirst($this->hero, $this->monster);

        $this->output->addMsg($whoIsFirst->getName() . " hit first");

        $this->round = new Round();
        $this->round->attacker = $whoIsFirst;
        $this->round->defender = ($whoIsFirst instanceof Orderus) ? $this->monster : $this->hero;
    }

    protected function _play()
    {
        while ($this->isInGame && $this->round->areRoundsLeft()) {
            $this->output->addMsg("Round #" . $this->round->getCurrentRound());
            $this->addRemainingHealthToOutputStack();
            $attackerStrength = $this->_getAttackerStrength();
            $defenderDefence = $this->round->defender->getStatsValue(Defence::class);

            $damageProduced = GameHelper::calcAttackFormula($attackerStrength, $defenderDefence);
            $this->output->addMsg($this->round->attacker->getName() . "'s hit will produce ". $damageProduced . " damage");

            $this->round->defender->substractDamage($damageProduced);

            if (!$this->round->defender->isAlive()) {
                $this->_finish($this->round->attacker);
            } else {
                $this->round->nextRound();
            }
        }

        if (!$this->round->areRoundsLeft() && $this->isInGame) {
            $winner = $this->_detectTheWinnerNow();
            $this->_finish($winner);
        }
    }

    protected function _detectTheWinnerNow()
    {
        $attackerHealth = $this->round->attacker->getStatsValue(Health::class);
        $defenderHealth = $this->round->defender->getStatsValue(Health::class);

        if ($attackerHealth > $defenderHealth) {
            return $this->round->attacker;
        }elseif ($attackerHealth < $defenderHealth) {
            return $this->round->defender;
        } else {
            //TODO: No case for equal health left
        }

        return null;
    }

    protected function _finish($winner)
    {
        $this->isInGame = false;
        $this->addRemainingHealthToOutputStack();
        $this->output->addMsg($winner->getName() . " won");
    }

    protected function addRemainingHealthToOutputStack()
    {
        $this->output->addMsg(
            GameHelper::convertStatsToSign($this->round->defender->getStatsValue(Health::class),
                $this->round->attacker->getStatsValue(Health::class),
                "+",
                "-",
                $this->round->getCurrentRound() % 2
            )
        );
    }

    protected function _getAttackerStrength()
    {
        $attackerStrength = $this->round->attacker->getStatsValue(Strength::class);

        $strengthMultiplier = 1;
        $strengthMultiplier *= $this->_getSkillByPlayer($this->round->attacker, true);
        $strengthMultiplier *= $this->_getSkillByPlayer($this->round->defender, false);

        if ($strengthMultiplier > 1) {
            $this->output->addMsg("Old Damage: $attackerStrength; Multiplier: $strengthMultiplier");
        }

        $attackerStrength *= $strengthMultiplier;



        return $attackerStrength;
    }

    protected function _getSkillByPlayer(Player $player, $checkForAttack = true)
    {
        $damageMultiplier = 1;
        if (!empty($player->getSkills())) {
            foreach ($player->getSkills() as $skill) {
                if ($skill->isForAttack && $checkForAttack) {
                    if ($skill->mayUseIt()) {
                        $this->output->addMsg($player->getName() . " will use " . $skill->getName());
                        $damageMultiplier *= $skill->getValue();
                    }
                }
            }
        }

        return $damageMultiplier;
    }


}