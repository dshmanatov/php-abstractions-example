<?php

namespace App\Core\Contracts\Logging;

use Psr\Log\LoggerInterface;

interface BufferedLogger extends LoggerInterface
{
    public function toArray();

    public function flush();
}
