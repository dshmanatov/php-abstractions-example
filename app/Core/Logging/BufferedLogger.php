<?php

namespace App\Core\Logging;

use App\Core\Contracts\Behavioural\PrettyDescription;
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
        $message = collect($context)
            ->map(function ($value, $key) {
                if ($value instanceof PrettyDescription) {
                    $string = $value->getPrettyDescription();
                } elseif ($value instanceof \Stringable) {
                    $string = (string)$value;
                } else {
                    $string = json_encode($value, JSON_PRETTY_PRINT, 2);
                }

                return "{$key}: {$string}";
            })
            ->prepend($message)
            ->join("\n");

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
