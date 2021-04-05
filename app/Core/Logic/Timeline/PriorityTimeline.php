<?php

namespace App\Core\Logic\Timeline;

use App\Core\Contracts\Timeline\TimelineEntry;
use SplPriorityQueue;

/**
 * Class PriorityTimeline
 *
 * @package App\Core\Logic\Timeline
 */
class PriorityTimeline extends AbstractTimeline
{
    /**
     * Store timeline entries
     *
     * @var SplPriorityQueue
     */
    protected $queue;

    /**
     * PriorityTimeline constructor.
     */
    public function __construct()
    {
        $this->queue = new SplPriorityQueue();
    }

    /**
     * Add an antry to the queue
     *
     * @param TimelineEntry $entry
     */
    public function add(TimelineEntry $entry)
    {
        $this->queue
            ->insert($entry, $this->entryToPriority($entry));
    }

    /**
     * Return true if queue is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->queue->isEmpty();
    }

    /**
     * Pick next entry
     *
     * @return TimelineEntry
     */
    public function next()
    {
        return $this->isEmpty()
            ? null
            : $this->queue->extract();
    }

    /**
     * Return an internal representation of the priority
     *
     * @param TimelineEntry $entry
     * @return int
     */
    protected function entryToPriority(TimelineEntry $entry)
    {
        return -($entry->getTimelineInterval()->getNext()->getPosition());
    }
}
