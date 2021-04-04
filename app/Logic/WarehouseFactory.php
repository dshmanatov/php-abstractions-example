<?php
namespace App\Logic;

class WarehouseFactory
{
    public static function fromCollection($items)
    {
        $warehouse = app()->make(\App\Contracts\Warehouse::class);

        collect($items)
            ->each(function($item) use ($warehouse) {
                $warehouse->add($item);
            });

        return $warehouse;
    }
}
