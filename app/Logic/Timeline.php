<?php
namespace App\Logic;

use App\Contracts\TimelineJob;
use SplPriorityQueue;

class Timeline implements \App\Contracts\Timeline {
    private $queue;

    public function __construct()
    {
        $this->queue = new SplPriorityQueue();
    }

    public function addJob(TimelineJob $job)
    {
        // Due to heap's nature, reverse elements order
        $this->queue->insert($job, -$job->getEnd());
    }

    public function hasJobs()
    {
        return $this->queue->valid();
    }

    public function extractJob()
    {
        return $this->hasJobs()
            ? $this->queue->extract()
            : null;
    }
}
