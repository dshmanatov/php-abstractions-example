<?php

namespace App\Logic;

use App\Contracts\RecipeResource;
use App\Contracts\WorkshopRecipe;
use App\Contracts\WorkshopRecipeResource;
use App\Exceptions\WarehouseOutOfStock;

class Warehouse extends AbstractWarehouse
{
    /**
     * @param WorkshopRecipe $recipe
     * @throws WarehouseOutOfStock
     */
    public function grab(WorkshopRecipe $recipe)
    {
        $resources = collect($recipe->getResources());

        // Find first resource missing (if any)
        $missingResource = $resources
            ->first(function(RecipeResource $resource) {
                $id = $resource->getUniqueId();

                $existing = $this->getById($id);

                return !$existing
                        || $existing->getStock() < $resource->getQuantity();
            });

        if ($missingResource) {
            throw new WarehouseOutOfStock("Ресурс закончился");
        }

        $resources->each(function(RecipeResource $resource) {
            $this->getById($resource->getUniqueId())
                ->decreaseStock($resource->getQuantity());
        });
    }
}
