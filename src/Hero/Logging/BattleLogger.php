<?php
/**
 * User: florinpo
 * Date: 22/07/2017
 * Time: 17:04
 */

namespace Hero\Logging;

class BattleLogger implements Logger
{
    public function output(string $msg) {
        echo $msg . '<br />';
    }
}
