<?php

namespace App\Logic;

use App\Contracts\DurationAware;
use App\Contracts\Timeline;
use App\Contracts\TimelineInterval;
use App\Contracts\Warehouse;
use App\Contracts\Workshop;
use App\Core\Contracts\Fabrication\Consumer;
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
     * @var Consumer
     */
    private $consumer;

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

            $this->log('Создана задача', $workshop, $task, true);
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

            yield $task->getResult();

            // Schedule another task for the same workshop at the end of the last interval
            $this->createTask(
                $task->getWorkshop(),
                $entry->getTimelineInterval()->getNext()
            );
        }
    }

    /**
     * @param                   $message
     * @param Workshop          $workshop
     * @param WorkshopTask|null $task
     * @param bool              $includeWarehouse
     */
    protected function log($message, Workshop $workshop, $task = null, $includeWarehouse = false)
    {
        $message = "{$message}: {$workshop->getName()}";

        if ($task) {
            $message .= " - задача {$task}";
        }

        if ($includeWarehouse) {
            $message .= " <br>Склад: " . $this->warehouse;
        }

        $this->logger->info($message);
    }

    public function run()
    {
        foreach ($this->produce() as $value) {
            $this->consumer->add($value);
        }
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

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }
}
