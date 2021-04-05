<?php

namespace App\Core\Types;

class PositionalTimelineInterval extends AbstractTimelineInterval
{
    /**
     * PositionalTimelineInterval constructor.
     *
     * @param integer $start
     * @param integer $duration
     */
    public function __construct($start, $duration)
    {
        $this->start = $start;
        $this->duration = $duration;
    }
}
