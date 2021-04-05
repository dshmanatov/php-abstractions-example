<?php
namespace App\Logging;

use Illuminate\Contracts\Support\Arrayable;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class SimpleLogger implements LoggerInterface, Arrayable
{
    use LoggerTrait;

    private $messages = [];

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, $message, array $context = array())
    {
        $this->messages[] = $message;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->messages;
    }
}

