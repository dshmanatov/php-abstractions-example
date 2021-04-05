<?php
namespace App\Core\Contracts\Timeline;

use App\Core\Contracts\Behavioural\Taskable;

interface TimelineEntry
{
    /**
     * @param Taskable $task
     * @return mixed
     */
    public function setTask(Taskable $task);

    /**
     * @return Taskable
     */
    public function getTask();

    /**
     * @return TimelineInterval
     */
    public function getTimelineInterval();
}
