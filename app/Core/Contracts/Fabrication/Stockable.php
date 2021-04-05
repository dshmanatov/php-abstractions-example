<?php

namespace App\Core\Contracts\Fabrication;

/**
 * Interface Stockable
 *
 * @package App\Core\Contracts\Fabrication
 */
interface Stockable
{
    /**
     * Get current stock
     *
     * @return mixed
     */
    public function getStock();

    /**
     * Increase stock by
     *
     * @param $quantity
     * @return void
     */
    public function increaseStock($quantity);

    /**
     * Decrease stock by
     *
     * @param $quantity
     * @return void
     */
    public function decreaseStock($quantity);
}
