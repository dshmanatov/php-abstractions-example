<?php

namespace App\Logic;

use App\Core\Contracts\Fabrication\Consumable;

/**
 * Class FabricationConsumer
 *
 * Конкретный потребитель, учитывающий количества произведенных consumables
 *
 * @package App\Logic
 */
class FabricationConsumer implements \App\Contracts\FabricationConsumer
{
    /**
     * Store produced items here
     *
     * @var array
     */
    private $items = [];

    /**
     * Pick a consumable
     *
     * @param Consumable $consumable
     */
    public function add(Consumable $consumable)
    {
        $key = (string)$consumable;

        if (!isset($this->items[$key])) {
            $this->items[$key] = 0;
        }

        $this->items[$key]++;
    }

    /**
     * Return produced consumables as array
     *
     * @return array
     */
    public function toArray()
    {
        return collect($this->items)
            ->map(function ($item, $key) {
                return "{$key} => {$item} шт.";
            })
            ->values()
            ->toArray();
    }
}
