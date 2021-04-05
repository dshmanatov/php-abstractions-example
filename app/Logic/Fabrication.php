<?php

namespace App\Logic;

use App\Contracts\DurationAware;
use App\Contracts\Timeline;
use App\Contracts\TimelineInterval;
use App\Contracts\Workshop;
use App\Core\Types\PositionalTimelineInterval;
use App\Tasks\WorkshopTask;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Fabrication implements \App\Contracts\Fabrication
{
    /**
     * @var \App\Contracts\Warehouse
     */
    private $warehouse;

    /**
     * @var Collection
     */
    private $workshops;

    /** @var Timeline */
    private $timeline;

    public function __construct(
        $warehouse,
        $workshops,
        Timeline $timeline
    )
    {
        $this->warehouse = $warehouse;
        $this->workshops = $workshops;
        $this->timeline = $timeline;
    }

    /**
     * Creates a new workshop job in a timeline
     *
     * @param Workshop         $workshop
     * @param TimelineInterval $start
     */
    protected function createTask(Workshop $workshop, TimelineInterval $start = null)
    {
        /** @var DurationAware $task */
        if ($task = $workshop->createTask($this->warehouse)) {
            if ($start) {
                $start->setDuration($task->getDuration());
            } else {
                $start = new PositionalTimelineInterval(0, $task->getDuration());
            }

            $entry = new TimelineEntry($task, $start);

            $this
                ->timeline
                ->add($entry);
        };
    }

    /**
     * @return \Generator|WorkshopTask[]
     */
    public function produce()
    {
        $this->workshops->each(function (Workshop $workshop) {
            $this->createTask($workshop);
        });

        /** @var TimelineEntry $entry */
        while ($entry = $this->timeline->next()) {
            /** @var WorkshopTask $task */
            $task = $entry->getTask();

            Log::channel('manufacturing')->info("Фабрика {$task->getWorkshop()->getName()}");

            yield $task;

            // Schedule another task for the same workshop at the end of the last interval
            $this->createTask(
                $task->getWorkshop(),
                $entry->getTimelineInterval()->getNext()
            );
        }
    }

    public function run()
    {
        $result = [];

        foreach ($this->produce() as $value) {
            $result[] = $value;
        }

        return $result;
    }
}
