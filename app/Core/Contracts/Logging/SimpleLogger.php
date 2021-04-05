<?php

namespace App\Core\Contracts\Logging;

interface SimpleLogger
{
    public function log(\Stringable $message);
}
