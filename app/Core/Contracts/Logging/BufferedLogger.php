<?php

namespace App\Core\Contracts\Logging;

use Illuminate\Contracts\Support\Arrayable;
use Psr\Log\LoggerInterface;

interface BufferedLogger extends LoggerInterface, Arrayable
{
    public function flush();
}
