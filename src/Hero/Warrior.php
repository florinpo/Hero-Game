<?php
/**
 * User: florinpo
 * Date: 19/07/2017
 * Time: 20:54
 */

namespace Hero;

use Hero\Skill\AttackSkill;
use Hero\Skill\DefenseSkill;
use PHPUnit\Framework\PHPUnit_Framework_TestCase;

class Warrior
{
    private $name;
    private $health;
    private $strength;
    private $defense;
    private $speed;
    private $luck;
    private $turns;

    protected $attackSkills = array();
    protected $defenseSkills = array();

    public function __construct($name, $health, $strength, $defense, $speed, $luck, $turns)
    {
        $this->name = $name;
        $this->health = $health;
        $this->strength = $strength;
        $this->defense = $defense;
        $this->speed = $speed;
        $this->luck = $luck;
        $this->turns = $turns;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setHealth($health) {
        $this->health = $health;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setDefense($defense)
    {
        $this->defense = $defense;
    }

    public function getDefense()
    {
        return $this->defense;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    public function getSpeed(){
        return $this->speed;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setTurns($turns)
    {
        $this->turns = $turns;
    }

    public function getTurns()
    {
        return $this->turns;
    }

    public function isAlive()
    {
        return $this->health > 0;
    }

    public function avoidAttack()
    {
        return $this->luck == mt_rand(1, 100);
    }

    public function hasTurnsLeft()
    {
        return $this->turns > 0;
    }

    public function isDefeated()
    {
        return !$this->isAlive() || !$this->hasTurnsLeft();
    }

    public function addAttackSkill(AttackSkill $skill)
    {
        $this->attackSkills[] = $skill;
    }

    public function addDefenceSkill(DefenseSkill $skill)
    {
        $this->defenseSkills[] = $skill;
    }

    public function attack(Warrior $warrior)
    {
        $this->setTurns($this->getTurns() - 1);
        $damage = 0;

        if (count($this->attackSkills) > 0) {
            foreach ($this->attackSkills as $skill) {
                $damage += $skill->performAttack();
            }
        }

        $damage = $this->getStrength();
        $warrior->defend($damage);
    }

    public function defend($attack)
    {
        if ($this->avoidAttack()) {
            return;
        }

        $damage = 0;

        if (count($this->defenseSkills) > 0) {
            foreach ($this->defenseSkills as $skill) {
                $damage += $attack - $skill->performDefense();
            }
        }

        $damage = $attack - $this->getDefense();

        if ($damage > 0) {
            $this->setHealth($this->getHealth() - $damage);
        }
    }
}
