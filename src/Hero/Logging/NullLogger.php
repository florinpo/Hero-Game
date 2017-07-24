<?php
/**
 * User: florinpo
 * Date: 22/07/2017
 * Time: 18:22
 */

namespace Hero\Logging;

class NullLogger implements Logger
{
    public function output(string $msg) {
        // do nothing
    }
}