<?php

namespace App\Logic;

use App\Contracts\DurationAware;
use App\Contracts\Timeline;
use App\Contracts\TimelineInterval;
use App\Contracts\Warehouse;
use App\Contracts\Workshop;
use App\Core\Types\PositionalTimelineInterval;
use App\Tasks\WorkshopTask;
use Illuminate\Support\Collection;
use Psr\Log\LoggerAwareTrait;

class Fabricator implements \App\Contracts\Fabricator
{
    use LoggerAwareTrait;

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
        Timeline $timeline
    )
    {
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

            $this->log('Создана задача', $workshop, $task);
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

            if ($this->logger) {
                $this->log("Завершена задача", $task->getWorkshop(), $task);
            }

            yield $task;

            // Schedule another task for the same workshop at the end of the last interval
            $this->createTask(
                $task->getWorkshop(),
                $entry->getTimelineInterval()->getNext()
            );
        }
    }

    /**
     * @param Workshop          $workshop
     * @param WorkshopTask|null $task
     */
    protected function log($message, Workshop $workshop, $task = null)
    {
        $message = "{$message}: {$workshop->getName()}";

        if ($task) {
            $message .= " - задача {$task}";
        }

        $this->logger->info($message);
    }

    public function run()
    {
        $result = [];

        foreach ($this->produce() as $value) {
            $result[] = $value;
        }

        return $result;
    }

    /**
     * @param Warehouse $warehouse
     * @return self
     */
    public function setWarehouse(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     *
     * @param Collection|Workshop[] $workshops
     * @return self
     */
    public function setWorkshops($workshops)
    {
        $this->workshops = $workshops;

        return $this;
    }
}