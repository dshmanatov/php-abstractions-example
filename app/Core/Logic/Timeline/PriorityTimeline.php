<?php
namespace App\Core\Logic\Timeline;

use App\Contracts\TimelineEntry;
use SplPriorityQueue;

class PriorityTimeline extends AbstractTimeline
{
    protected $queue;

    public function __construct()
    {
        $this->queue = new SplPriorityQueue();
    }

    public function add(TimelineEntry $entry)
    {
        $this->queue
            ->insert($entry, $this->entryToPriority($entry));
    }

    public function isEmpty()
    {
        return $this->queue->isEmpty();
    }

    public function next()
    {
        return $this->isEmpty()
            ? null
            : $this->queue->extract();
    }

    protected function entryToPriority(TimelineEntry $entry)
    {
        return -($entry->getTimelineInterval()->getNext()->getPosition());
    }
}
