<?php

namespace App\Core\Contracts\Timeline;

use App\Core\Contracts\Behavioural\Durationable;

/**
 * Interface TimelineInterval
 *
 * @package App\Core\Contracts\Timeline
 */
interface TimelineInterval extends Durationable
{
    /**
     * @return mixed
     */
    public function getStart();

    /**
     * @param $duration
     * @return void
     */
    public function setDuration($duration);

    /**
     * Get a next interval
     *
     * @return self
     */
    public function getNext();

    /**
     * Return start as a fixed position (integer)
     *
     * @return int
     */
    public function getPosition();
}
