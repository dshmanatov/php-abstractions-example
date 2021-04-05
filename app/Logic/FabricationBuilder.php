<?php

namespace App\Logic;

use App\Core\Contracts\Creational\Builder;
use App\Core\Contracts\Fabrication\Consumer;
use App\Core\Contracts\Fabrication\Fabricator;
use App\Core\Contracts\Fabrication\Producer;
use App\Core\Contracts\Fabrication\Stock;
use App\Exceptions\FabricationBuilderException;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

/**
 * Class FabricationBuilder
 *
 * Билдер для создания Fabrication
 *
 * @package App\Logic
 */
class FabricationBuilder implements Builder
{
    /**
     * Склад/источник ресурсов
     *
     * @var Stock
     */
    private $stock;

    /**
     * Производители/фабрики
     *
     * @var Collection|Producer[]
     */
    private $producers;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Потребитель продукции
     *
     * @var Consumer
     */
    private $consumer;

    /**
     * FabricationBuilder constructor.
     */
    public function __construct()
    {
        $this->producers = collect();
        $this->stock = null;
        $this->logger = null;
    }

    /**
     * Set producers
     *
     * @param Producer[]|Collection $producers
     * @return $this
     */
    public function setProducers($producers)
    {
        $this->producers = collect($producers);

        return $this;
    }

    /**
     * Set stock
     *
     * @param $stock
     * @return $this
     */
    public function setStock($stock)
    {
        $this->stock = StockFactory::fromCollection($stock);

        return $this;
    }

    /**
     * Set logger
     *
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Set consumer
     *
     * @param Consumer $consumer
     * @return $this
     */
    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;

        return $this;
    }

    /**
     * Build a Fabricator instance
     *
     * @return Fabricator
     * @throws FabricationBuilderException
     */
    public function build()
    {
        if (is_null($this->stock)) {
            throw new FabricationBuilderException("Не задан источник ресурсов");
        }

        if ($this->producers->isEmpty()) {
            throw new FabricationBuilderException("Не заданы фабрики");
        }

        if (!$this->consumer instanceof Consumer) {
            throw new FabricationBuilderException("Не задан потребитель");
        }

        /** @var Fabricator $fabricator */
        $fabricator = app()->make(Fabricator::class);

        $fabricator->setStock($this->stock)
            ->setProducers($this->producers)
            ->setConsumer($this->consumer);

        $fabricator->setLogger($this->logger);

        return $fabricator;
    }
}
