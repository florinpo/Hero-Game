<?php
/**
 * User: florinpo
 * Date: 22/07/2017
 * Time: 17:28
 */

namespace Hero\Logging;

interface Logger
{
    public function output(string $msg);
}