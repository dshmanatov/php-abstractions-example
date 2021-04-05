<?php

namespace App\Logic;

use App\Core\Contracts\Fabrication\Consumer;
use App\Core\Contracts\Fabrication\DurationAwareTask;
use App\Core\Contracts\Fabrication\Producer;
use App\Core\Contracts\Fabrication\Stock;
use App\Core\Contracts\Timeline\Timeline;
use App\Core\Contracts\Timeline\TimelineInterval;
use App\Tasks\WorkshopTask;
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

            $this->log(
                'Создана задача',
                [
                    'producer' => $producer,
                    'task'     => $task,
                    'stock'    => $this->stock
                ]
            );
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
                new \App\Logic\TimelineInterval());
        });

        /** @var TimelineEntry $entry */
        while ($entry = $this->timeline->next()) {
            /** @var WorkshopTask $task */
            $task = $entry->getTask();

            if ($this->logger) {
                $this->log(
                    "Завершена задача",
                    [
                        'task' => $task->getProducer(),
                        'task' => $task
                    ]
                );
            }

            yield $task->getResult();

            // Schedule another task for the same producer at the end of the last interval
            $this->createTask(
                $task->getProducer(),
                $entry->getTimelineInterval()->getNext()
            );
        }
    }

    /**
     * Выводим в лог.
     *
     * @param                   $message
     * @param array             $context
     */
    protected function log($message, $context)
    {
        if ($this->logger) {
            $this->logger->info($message, $context);
        }
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
     * @param Stock $stock
     * @return $this
     */
    public function setStock(Stock $stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @param Consumer $consumer
     * @return $this
     */
    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;

        return $this;
    }

    /**
     * Set producers
     *
     * @param Collection|Producer[] $producers
     * @return $this
     */
    public function setProducers($producers)
    {
        $this->producers = $producers;

        return $this;
    }
}
