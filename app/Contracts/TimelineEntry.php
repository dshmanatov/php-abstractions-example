<?php
namespace App\Contracts;

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
