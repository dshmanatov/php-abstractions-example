<?php

namespace App\Logic;

use App\Exceptions\FabricationBuilderException;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

class FabricationBuilder
{
    private $warehouse;

    private $workshops;

    private $logger;

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

    /**
     * @return \App\Contracts\Fabrication
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

        /** @var \App\Contracts\Fabrication $fabrication */
        $fabrication = app()->make(\App\Contracts\Fabrication::class);

        $fabrication->setWarehouse($this->warehouse)
            ->setWorkshops($this->workshops);

        $fabrication->setLogger($this->logger);

        return $fabrication;
    }
}
