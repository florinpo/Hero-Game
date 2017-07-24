<?php
/**
 * User: florinpo
 * Date: 22/07/2017
 * Time: 19:22
 */

namespace Hero\Skill;

use Hero\Logging\NullLogger;
use Hero\Warrior;

class RapidStrikeSkill implements AttackSkill
{
    public $name = 'Rapid strike skill';
    private $warrior;
    private $chance;
    private $logger;

    public function __construct(Warrior $warrior, int $chance, $logger = null)
    {
        $this->warrior = $warrior;
        $this->chance = $chance;
        $this->logger = !isset($logger) ? new NullLogger() : $logger;
    }

   public function performAttack()
   {
       if ($this->chance == mt_rand(1, 100)) {
           $damage = $this->warrior->getStrength() * 2;
           $this->logger->output(sprintf("%s has been used %s.", $this->warrior->getName(), $this->name));
       }

       $damage = $this->warrior->getStrength();

       return $damage;
   }
}

