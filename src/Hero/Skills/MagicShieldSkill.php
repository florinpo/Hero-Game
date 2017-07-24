<?php
/**
 * User: florinpo
 * Date: 22/07/2017
 * Time: 20:08
 */

namespace Hero\Skill;

use Hero\Logging\NullLogger;
use Hero\Warrior;

class MagicShieldSkill implements DefenseSkill
{
    public $name = 'Magic shield skill';
    private $warrior;
    private $chance;
    private $logger;

    public function __construct(Warrior $warrior, int $chance, $logger = null)
    {
        $this->warrior = $warrior;
        $this->chance = $chance;
        $this->logger = !isset($logger) ? new NullLogger() : $logger;
    }

    public function performDefense()
    {
        if ($this->chance == mt_rand(1, 100)) {
            $damage = $this->warrior->getDefense() / 2;
            $this->logger->output(sprintf("%s has been used %s.", $this->warrior->getName(), $this->name));
        }

        $damage = $this->warrior->getDefense();

        return $damage;
    }
}
