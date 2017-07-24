<?php
/**
 * User: florinpo
 * Date: 20/07/2017
 * Time: 09:13
 */

namespace Hero;

use PHPUnit\Framework\TestCase;

class BattleTest extends TestCase
{
    /**
     * @dataProvider providerForWarriors
     */
    public function testCanFight($w1, $w2)
    {
        $battle = $this->getMockBuilder(Battle::class)
            ->setConstructorArgs(array($w1, $w2))
            ->getMock();

        $battle->expects($this->once())
            ->method('fight');

        $battle->fight();
    }

    /**
     * @dataProvider providerForWin
     */
    public function testCanWin($w1, $w2)
    {
        $battle = new Battle($w1, $w2);

        $this->assertTrue($w1->isAlive());
        $this->assertTrue($w2->isAlive());

        $battle->fight();

        $this->assertTrue($w1->isAlive());
        $this->assertTrue($w2->isDefeated());
    }

    /**
     * @dataProvider providerForLose
     */
    public function testCanLose($w1, $w2)
    {
        $battle = new Battle($w1, $w2);

        $this->assertTrue($w1->isAlive());
        $this->assertTrue($w2->isAlive());

        $battle->fight();

        $this->assertTrue($w2->isAlive());
        $this->assertTrue($w1->isDefeated());
    }

    /**
     * @dataProvider providerForDraw
     */
    public function testCanDraw($w1, $w2)
    {
        $battle = new Battle($w1, $w2);

        $this->assertTrue($w1->isAlive());
        $this->assertTrue($w2->isAlive());

        $battle->fight();

        $this->assertTrue($w1->isAlive());
        $this->assertTrue($w2->isAlive());
    }

    public function providerForWin()
    {
        return [
            [
               new Warrior('Orderus', 100, 100, 100, 100, 100, 1),
               new Warrior('Beast', 50, 100, 100, 100, 100, 1)
            ],
            [
                new Warrior('Orderus', 50, 60, 10, 100, 40, 5),
                new Warrior('Beast', 50, 50, 5, 50, 10, 5)
            ],
            [
                new Warrior('Orderus', 100, 0, 0, 0, 0, 3),
                new Warrior('Beast', 60, 0, 0, 0, 0, 3)
            ]
        ];
    }

    public function providerForDraw()
    {
        return [
            [
                new Warrior('Orderus', 100, 100, 100, 100, 0, 10),
                new Warrior('Beast', 100, 100, 100, 100, 0, 10)
            ],
            [
                new Warrior('Orderus', 30, 0, 0, 0, 0, 4),
                new Warrior('Beast', 30, 0, 0, 0, 0, 4)
            ],
        ];
    }

    public function providerForLose()
    {
        return [
            [
                new Warrior('Orderus', 50, 100, 100, 100, 0, 10),
                new Warrior('Beast', 100, 100, 100, 100, 0, 11)
            ],
            [
                new Warrior('Orderus', 50, 50, 10, 50, 10, 5),
                new Warrior('Beast', 100, 50, 10, 100, 40, 6)
            ],
            [
                new Warrior('Orderus', 50, 0, 0, 0, 0, 3),
                new Warrior('Beast', 100, 0, 0, 0, 0, 4)
            ],
        ];
    }

    public function providerForWarriors()
    {
        return [
            [
                new Warrior(
                    'Orderus',
                    mt_rand(70, 100),
                    mt_rand(70, 80),
                    mt_rand(45, 55),
                    mt_rand(40, 50),
                    mt_rand(10, 30),
                    20
                ),
                new Warrior(
                    'Beast',
                    mt_rand(60, 90),
                    mt_rand(60, 90),
                    mt_rand(40, 60),
                    mt_rand(40, 60),
                    mt_rand(25, 45),
                    20
                )
            ],
            [
                new Warrior(
                    'Orderus',
                    mt_rand(70, 100),
                    mt_rand(70, 80),
                    0,
                    0,
                    mt_rand(10, 30),
                    1
                ),
                new Warrior(
                    'Beast',
                    mt_rand(60, 90),
                    10,
                    mt_rand(40, 60),
                    mt_rand(40, 60),
                    mt_rand(25, 45),
                    1
                )
            ]
        ];
    }
}
