<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Psr\Log\LoggerAwareInterface;

interface Fabrication extends LoggerAwareInterface
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

    /**
     * @return mixed
     */
    public function run();
}
