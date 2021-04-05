<?php

namespace App\Core\Contracts\Fabrication;

use Illuminate\Support\Collection;
use Psr\Log\LoggerAwareInterface;

/**
 * Interface Fabricator
 *
 * @package App\Core\Contracts\Fabrication
 */
interface Fabricator extends LoggerAwareInterface
{
    /**
     * @param Stock $warehouse
     * @return $this
     */
    public function setStock(Stock $warehouse);

    /**
     * Set producers
     *
     * @param Collection|Producer[] $producers
     * @return $this
     */
    public function setProducers($producers);

    /**
     * Set a consumer
     *
     * @param Consumer $consumer
     * @return $this
     */
    public function setConsumer(Consumer $consumer);

    /**
     * Run
     *
     * @return void
     */
    public function run();
}
