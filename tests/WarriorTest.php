<?php

/**
 * User: florinpo
 * Date: 20/07/2017
 * Time: 11:10
 */
namespace Hero;

use PHPUnit\Framework\TestCase;

class WarriorTest extends TestCase
{
    private $warior1Mockup;
    private $warior2Mockup;
    private $attackSkillMockup;
    private $defenseSkillMockup;

    public function setUp()
    {
        $this->warior1Mockup = $this->getMockBuilder(Warrior::class)
            ->setConstructorArgs(array('Orderus', 100, 100, 100, 100, 100, 1));
        $this->warior2Mockup = $this->getMockBuilder(Warrior::class)
            ->setConstructorArgs(array('Beast', 100, 100, 100, 100, 100, 1));
        $this->attackSkillMockup = $this->getMockBuilder(Skill\RapidStrikeSkill::class);
        $this->defenseSkillMockup = $this->getMockBuilder(Skill\MagicShieldSkill::class);
    }

    public function testCanAttack()
    {
        $w1 = $this->warior1Mockup
            ->setMethods(array('getStrength'))
            ->getMock();

        $w2 = $this->warior2Mockup
            ->setMethods(array('getStrength'))
            ->getMock();

        $w1->expects($this->once())
            ->method('getStrength');

        $w2->expects($this->once())
            ->method('getStrength');

        $w1->attack($w2);
        $w2->attack($w1);
    }

    public function testCanUseAttackSkill()
    {
        $w1 = new Warrior('Orderus', 100, 100, 100, 100, 100, 1);
        $w2 = new Warrior('Beast', 100, 100, 100, 100, 100, 1);

        $attackSkill = $this->attackSkillMockup
            ->setConstructorArgs([$w1, 100])
            ->setMethods(array('performAttack'))
            ->getMock();

        $attackSkill->expects($this->once())
            ->method('performAttack');

        $w1->addAttackSkill($attackSkill);
        $w1->attack($w2);
    }

    public function testCanDefend()
    {
        $w1 = $this->warior1Mockup
            ->setMethods(array('getDefense'))
            ->getMock();

        $w2 = $this->warior2Mockup
            ->setMethods(array('getDefense'))
            ->getMock();

        $w1->expects($this->once())
            ->method('getDefense');

        $w2->expects($this->once())
            ->method('getDefense');

        $w1->defend(30);
        $w2->defend(10);
    }

    public function testCanUseDefenseSkill()
    {
        $w1 = new Warrior('Orderus', 100, 100, 100, 100, 0, 1);

        $defenseSkill = $this->defenseSkillMockup
            ->setConstructorArgs([$w1, 100])
            ->setMethods(array('performDefense'))
            ->getMock();

        $defenseSkill->expects($this->once())
            ->method('performDefense');

        $w1->addDefenceSkill($defenseSkill);
        $w1->defend(30);
    }
}
