<?php
namespace App\Core\Logging;

use Psr\Log\AbstractLogger;

class BufferedLogger extends AbstractLogger implements \App\Core\Contracts\Logging\BufferedLogger
{
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

    public function toArray()
    {
        return $this->messages;
    }

    public function flush()
    {
        $this->messages = [];
    }
}

