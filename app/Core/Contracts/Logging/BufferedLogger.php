<?php

namespace App\Core\Contracts\Logging;

interface BufferedLogger
{
    public function toArray();

    public function flush();
}
