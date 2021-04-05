<?php

namespace App\Logic;

use App\Core\Contracts\Fabrication\Consumer;
use App\Exceptions\FabricationBuilderException;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

class FabricationBuilder
{
    private $warehouse;

    private $workshops;

    private $logger;

    private $consumer;

    public function __construct()
    {
        $this->warehouse = null;
        $this->workshops = collect();
        $this->logger = null;
    }

    /**
     */
    public function setWorkshops($workshops)
    {
        $this->workshops = $workshops;

        return $this;
    }

    public function setWarehouse($items)
    {
        $this->warehouse = WarehouseFactory::fromCollection($items);

        return $this;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    public function setConsumer(Consumer $consumer)
    {
        $this->consumer = $consumer;

        return $this;
    }

    /**
     * @return \App\Contracts\Fabricator
     * @throws FabricationBuilderException
     */
    public function build()
    {
        if (is_null($this->warehouse)) {
            throw new FabricationBuilderException("Не задан источник ресурсов");
        }

        if ($this->workshops->isEmpty()) {
            throw new FabricationBuilderException("Не заданы фабрики");
        }

        if (!$this->consumer instanceof Consumer) {
            throw new FabricationBuilderException("Не задан потребитель");
        }

        /** @var \App\Contracts\Fabricator $fabricator */
        $fabricator = app()->make(\App\Contracts\Fabricator::class);

        $fabricator->setWarehouse($this->warehouse)
            ->setWorkshops($this->workshops)
            ->setConsumer($this->consumer);

        $fabricator->setLogger($this->logger);

        return $fabricator;
    }
}
