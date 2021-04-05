<?php

namespace App\Core\Contracts\Fabrication;

/**
 * Interface Stock
 *
 * @package App\Core\Contracts\Fabrication
 */
interface Stock
{
    /**
     * Add item to stock/warehouse
     *
     * @param StockableItem $item
     * @return void
     */
    public function add(StockableItem $item);

    /**
     * Grab items
     *
     * @param Recipe $recipe
     * @return void
     */
    public function grab(Recipe $recipe);
}
