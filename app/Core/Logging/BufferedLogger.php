<?php

namespace App\Core\Logging;

use Psr\Log\AbstractLogger;

/**
 * Class BufferedLogger
 *
 * Write log data to buffer
 *
 * @package App\Core\Logging
 */
class BufferedLogger extends AbstractLogger implements \App\Core\Contracts\Logging\BufferedLogger
{
    /**
     * Store buffered log records
     *
     * @var string[]
     */
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
     * Return buffered data as plain array
     *
     * @return \string[]
     */
    public function toArray()
    {
        return $this->messages;
    }

    /**
     * Clear buffer
     */
    public function flush()
    {
        $this->messages = [];
    }
}

