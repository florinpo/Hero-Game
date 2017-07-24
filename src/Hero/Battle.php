<?php
/**
 * User: florinpo
 * Date: 22/07/2017
 * Time: 16:59
 */

namespace Hero;

use Hero\Logging\NullLogger;

class Battle
{
    private $w1;
    private $w2;
    private $logger;

    public function __construct(Warrior $w1, Warrior $w2, $logger = null)
    {
        $this->w1 = $w1;
        $this->w2 = $w2;
        $this->logger = !isset($logger) ? new NullLogger() : $logger;
    }

    public function fight()
    {
        $this->logger->output('The battle has begun.');
        list($w1, $w2) = self::projectFight($this->w1, $this->w2);

        while (!$w1->isDefeated() && !$w2->isDefeated()) {
            $w1->attack($w2);
            $this->logger->output(sprintf("%s has %u turns left.", $w2->getName(), $w2->getTurns()));
            $w2->attack($w1);
            $this->logger->output(sprintf("%s has %u turns left.", $w1->getName(), $w1->getTurns()));
        }

        if ($w1->isAlive() && $w2->isAlive()) {
            $this->logger->output('Draw!');
        } elseif ($w1->isAlive()) {

            $this->logger->output(sprintf("%s won!", $w1->getName()));
        } else {
            $this->logger->output(sprintf("%s won!", $w2->getName()));
        }
    }

    protected static function projectFight(Warrior $w1, Warrior $w2)
    {
        $result = array($w1, $w2);

        if ($w1->getSpeed() > $w2->getSpeed()) {
            $w1->attack($w2);
            $result = array($w2, $w1);
        } elseif ($w1->getSpeed() == $w2->getSpeed()) {
            if ($w1->getDefense() < $w2->getDefense()) {
                $w1->attack($w2);
                $result = array($w2, $w1);
            } else {
                $w2->attack($w1);
            }
        } else {
            $w2->attack($w1);
        }

        return $result;
    }
}
