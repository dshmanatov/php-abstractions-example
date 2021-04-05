<?php

namespace App\Core\Types;

use App\Contracts\Positionable;
use App\Contracts\TimelineInterval;

abstract class AbstractTimelineInterval implements TimelineInterval
{
    protected $start;

    protected $duration;

    public function getStart()
    {
        return $this->start;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getNext()
    {
        return new static($this->start + $this->duration, $this->duration);
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->start;
    }
}
