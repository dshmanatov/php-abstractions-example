<?php

namespace App\Logic;

use App\Exceptions\FabricationBuilderException;
use Illuminate\Support\Collection;

class FabricationBuilder
{
    private $warehouse;

    private $workshops;

    public function __construct()
    {
        $this->warehouse = null;
        $this->workshops = collect();
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

        return app()->makeWith(\App\Contracts\Fabrication::class, [
            'warehouse' => $this->warehouse,
            'workshops' => $this->workshops,
        ]);
    }
}
