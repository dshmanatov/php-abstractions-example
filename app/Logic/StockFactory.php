<?php

namespace App\Logic;

use App\Core\Contracts\Fabrication\Stock;
use App\Core\Contracts\Fabrication\StockableItem;
use Illuminate\Support\Collection;

/**
 * Class StockFactory
 *
 * @package App\Logic
 */
class StockFactory
{
    /**
     * Create a stock from item collection
     *
     * @param StockableItem[]|Collection $items
     * @return Stock
     */
    public static function fromCollection($items)
    {
        $warehouse = app()->make(Stock::class);

        collect($items)
            ->each(function ($item) use ($warehouse) {
                $warehouse->add($item);
            });

        return $warehouse;
    }
}
