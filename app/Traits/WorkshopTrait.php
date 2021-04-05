<?php

namespace App\Traits;

use App\Core\Contracts\Fabrication\ProducerRecipe;
use App\Core\Contracts\Fabrication\Stock;
use App\Core\Exceptions\OutOfStockException;
use App\Logic\TaskFactory;
use App\Tasks\WorkshopTask;
use Illuminate\Support\Collection;

trait WorkshopTrait
{
    /**
     * Schedule a new job for a workshop
     *
     * @param Stock $stock
     * @return WorkshopTask|null
     */
    public function createTask(Stock $stock)
    {
        /** @var Collection|ProducerRecipe[] $recipes */
        $recipes = $this->getRecipes();

        // Try grabbing resources from the stock
        /** @var ProducerRecipe $recipe */
        $recipe = $recipes->first(function ($producerRecipe) use ($stock) {
            try {
                $stock->grab($producerRecipe);

                return true;
            } catch (OutOfStockException $e) {
                // Handle exception internally
                return false;
            }
        });

        // We can now create an actual job here
        return $recipe ? TaskFactory::fromRecipe($recipe) : null;
    }
}

