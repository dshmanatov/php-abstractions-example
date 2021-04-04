<?php

namespace App\Traits;

use App\Contracts\Warehouse;
use App\Exceptions\WarehouseOutOfStock;
use App\Models\WorkshopRecipe;
use Illuminate\Support\Collection;

trait WorkshopTrait
{
    public function createJob(Warehouse $warehouse)
    {
        /** @var Collection|WorkshopRecipe[] $recipes */
        $recipes = $this->getRecipes();

        $recipes->first(function ($workshopRecipe) use ($warehouse) {
            try {
                $warehouse->grab($workshopRecipe);
            } catch (WarehouseOutOfStock $e) {
                //
            }
        });
    }
}

