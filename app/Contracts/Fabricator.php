<?php

namespace App\Contracts;

use App\Core\Contracts\Fabrication\Consumer;
use Illuminate\Support\Collection;
use Psr\Log\LoggerAwareInterface;

interface Fabricator extends LoggerAwareInterface
{
    /**
     * @param Warehouse $warehouse
     * @return self
     */
    public function setWarehouse(Warehouse $warehouse);

    /**
     *
     * @param Collection|Workshop[] $workshops
     * @return self
     */
    public function setWorkshops($workshops);

    public function run();

    public function setConsumer(Consumer $consumer);
}
