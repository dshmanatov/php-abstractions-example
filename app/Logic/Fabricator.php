<?php

namespace App\Logic;

use App\Core\Contracts\Behavioural\Taskable;
use App\Core\Contracts\Fabrication\Consumer;
use App\Core\Contracts\Fabrication\DurationAwareTask;
use App\Core\Contracts\Fabrication\Producer;
use App\Core\Contracts\Fabrication\Stock;
use App\Core\Contracts\Timeline\Timeline;
use App\Core\Contracts\Timeline\TimelineInterval;
use Illuminate\Support\Collection;
use Psr\Log\LoggerAwareTrait;

/**
 * Class Fabricator
 *
 * @package App\Logic
 */
class Fabricator implements \App\Core\Contracts\Fabrication\Fabricator
{
    use LoggerAwareTrait;

    /**
     * @var Stock
     */
    private $stock;

    /**
     * @var Consumer
     */
    private $consumer;

    /**
     * @var Collection|Producer[]
     */
    private $producers;

    /** @var Timeline */
    private $timeline;

    /**
     * Fabricator constructor.
     *
     * @param Timeline $timeline
     */
    public function __construct(
        Timeline $timeline
    )
    {
        $this->timeline = $timeline;
    }

    /**
     * Creates a new workshop job in a timeline
     *
     * @param Producer         $producer
     * @param TimelineInterval $start
     */
    protected function createTask(Producer $producer, TimelineInterval $start)
    {
        /** @var DurationAwareTask $task */
        if ($task = $producer->createTask($this->stock)) {
            $start->setDuration($task->getDuration());

            $entry = new TimelineEntry($task, $start);

            $this
                ->timeline
                ->add($entry);

            $this->log('Создана задача', ['producer' => $producer, 'task' => $task, 'stock' => $this->stock]);
        };
    }

    /**
     * Берем таск из таймлайна, запускаем в работу и получаем результат работы
     *
     * @return \Generator|WorkshopTask[]
     */
    public function produce()
    {
        // Первоначальное создание задач
        $this->producers->each(function (Producer $workshop) {
            $this->createTask(
                $workshop,
                new \stdClass());
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
     * Выводим в лог. Можно пойти дальше, добавить форматтеры и так далее.
     *
     * Так как это "concrete" Fabricator, на данном этапе не вижу необходимости в вынесении форматирования лога наружу
     *
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

    /**
     * Запуск производства
     */
    public function run()
    {
        foreach ($this->produce() as $value) {
            $this->consumer->add($value);
        }
    }

    /**
     * @param Stock $warehouse
     * @return self
     */
    public function setWarehouse(Stock $warehouse)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    /**
     * @param Stock $warehouse
     * @return self
     */
    public function setStock(Stock $warehouse)
    {
        // TODO: Implement setStock() method.
    }

    /**
     * Set producers
     *
     * @param Collection|Producer[] $producers
     * @return self
     */
    public function setProducers($producers)
    {
        $this->producers = $producers;
    }
}
