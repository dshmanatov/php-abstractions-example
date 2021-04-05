<?php

namespace App\Core\Logic\Timeline;

use App\Core\Contracts\Timeline\TimelineInterval;

/**
 * Class AbstractTimelineInterval
 *
 * @package App\Core\Logic\Timeline
 */
abstract class AbstractTimelineInterval implements TimelineInterval
{
    /**
     * Interval start
     *
     * @var
     */
    protected $start;

    /**
     * Interval duration
     *
     * @var
     */
    protected $duration;

    /**
     * Get interval start
     *
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set task duration
     *
     * @param $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * Return task duration
     *
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get next interval
     *
     * @return static
     */
    public function getNext()
    {
        return new static($this->start + $this->duration, $this->duration);
    }

    /**
     * Get position as integer
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->start;
    }
}
