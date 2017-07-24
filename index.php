<?php
require_once __DIR__.'/vendor/autoload.php';

$logger = new \Hero\Logging\BattleLogger();

$orderus = new \Hero\Warrior(
    'Orderus',
    mt_rand(70, 100),
    mt_rand(70, 80),
    mt_rand(45, 55),
    mt_rand(40, 50),
    mt_rand(10, 30),
    20
);

$beast = new \Hero\Warrior(
    'Beast',
    mt_rand(60, 90),
    mt_rand(60, 90),
    mt_rand(40, 60),
    mt_rand(40, 60),
    mt_rand(25, 45),
    20
);

$rapidStrikeSkill = new \Hero\Skill\RapidStrikeSkill($orderus, 10, $logger);
$magicShieldSkill = new \Hero\Skill\MagicShieldSkill($orderus, 20, $logger);

$orderus->addAttackSkill($rapidStrikeSkill);
$orderus->addDefenceSkill($magicShieldSkill);

$battle = new \Hero\Battle(
    $orderus,
    $beast,
    $logger
);

$battle->fight();
?>

