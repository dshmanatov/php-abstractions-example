<?php

namespace App\Logic;

use App\Core\Contracts\Fabrication\Recipe;
use App\Core\Contracts\Fabrication\RecipeItem;
use App\Core\Logic\Fabrication\AbstractStock;
use App\Exceptions\OutOfStockException;

/**
 * Class Stock
 *
 * Имплементация склада ресурсов
 *
 * @package App\Logic
 */
class Stock extends AbstractStock
{
    /**
     * @param $recipe
     * @throws OutOfStockException
     */
    public function grab(Recipe $recipe)
    {
        $resources = collect($recipe->getResources());

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
}
