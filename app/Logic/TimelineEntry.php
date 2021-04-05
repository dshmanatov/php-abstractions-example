<?php
namespace App\Logic;

use App\Contracts\Taskable;
use App\Contracts\TimelineInterval;

class TimelineEntry implements \App\Contracts\TimelineEntry
{
    private $task;

    private $start;

    function __construct($task, TimelineInterval $start)
    {
        $this->task = $task;
        $this->start = $start;
    }

    /**
     * @param Taskable $task
     * @return mixed
     */
    public function setTask(Taskable $task)
    {
        $this->task = $task;
    }

    /**
     * @return Taskable
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @return TimelineInterval
     */
    public function getTimelineInterval()
    {
        return $this->start;
    }
}
