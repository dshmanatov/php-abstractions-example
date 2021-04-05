<?php

namespace App\Core\Logic\Timeline;

use App\Core\Contracts\Behavioural\Taskable;
use App\Core\Contracts\Timeline\TimelineEntry;
use App\Core\Contracts\Timeline\TimelineInterval;

/**
 * Абстрактный class TimelineEntry
 *
 * @package App\Logic
 */
abstract class AbstractTimelineEntry implements TimelineEntry
{
    /**
     * @var Taskable
     */
    private $task;

    /**
     * @var TimelineInterval
     */
    private $start;

    /**
     * TimelineEntry constructor.
     *
     * @param                  $task
     * @param TimelineInterval $start
     */
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
