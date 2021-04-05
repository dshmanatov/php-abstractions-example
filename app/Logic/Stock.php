<?php

namespace App\Logic;

use App\Contracts\PrettyDescription;
use App\Core\Contracts\Fabrication\Recipe;
use App\Core\Contracts\Fabrication\RecipeItem;
use App\Core\Contracts\Fabrication\StockableItem;
use App\Core\Exceptions\OutOfStockException;
use App\Core\Logic\Fabrication\AbstractStock;
use App\Models\Resource;

/**
 * Class Stock
 *
 * Имплементация склада ресурсов
 *
 * @package App\Logic
 */
class Stock extends AbstractStock implements PrettyDescription
{
    /**
     * @param $recipe
     * @throws OutOfStockException
     */
    public function grab(Recipe $recipe)
    {
        $resources = collect($recipe->getItems());

        // Find first resource missing (if any)
        $missingResource = $resources
            ->first(function (RecipeItem $resource) {
                $id = $resource->getUniqueId();

                $existing = $this->getById($id);

                return !$existing
                    || $existing->getStock() < $resource->getQuantity();
            });

        if ($missingResource) {
            throw new OutOfStockException("Ресурс закончился");
        }

        $resources->each(function (RecipeItem $resource) {
            $this->getById($resource->getUniqueId())
                ->decreaseStock($resource->getQuantity());
        });
    }

    /**
     * This implementation is a little bit dumb, can be improved, it's getting sorta boring
     *
     * @return string
     */
    public function getPrettyDescription()
    {
        return collect($this->items)
            ->map(function (StockableItem $item) {
                return Resource::find($item->getUniqueId())->name
                    . ' = '
                    . $item->getStock();
            })
            ->join(', ');

    }
}
