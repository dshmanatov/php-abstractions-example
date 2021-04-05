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
     * @return mixed
     */
    public function increaseStock($quantity = 1);

    /**
     * Decrease stock by
     *
     * @param $quantity
     * @return mixed
     */
    public function decreaseStock($quantity = 1);
}
