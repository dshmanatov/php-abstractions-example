<?php

namespace App\Traits;

use App\Contracts\Warehouse;
use App\Exceptions\WarehouseOutOfStock;
use App\Logic\TaskFactory;
use App\Models\WorkshopRecipe;
use App\Tasks\WorkshopTask;
use Illuminate\Support\Collection;

trait WorkshopTrait
{
    /**
     * Schedule a new job for a workshop
     *
     * @param Warehouse $warehouse
     * @return WorkshopTask|null
     */
    public function createTask(Warehouse $warehouse)
    {
        /** @var Collection|WorkshopRecipe[] $recipes */
        $recipes = $this->getRecipes();

        // Try grabbing resources from the warehouse
        /** @var WorkshopRecipe $recipe */
        $recipe = $recipes->first(function ($workshopRecipe) use ($warehouse) {
            try {
                $warehouse->grab($workshopRecipe);

                return true;
            } catch (WarehouseOutOfStock $e) {
                return false;
            }
        });

        // We can now create an actual job here
        return $recipe ? TaskFactory::fromRecipe($recipe) : null;
    }
}

