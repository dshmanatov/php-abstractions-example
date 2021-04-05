<?php
namespace App\Logic;

use App\Contracts\WorkshopRecipe;
use App\Tasks\WorkshopTask;

class TaskFactory
{
    /**
     * Create concrete class instance
     *
     * @param WorkshopRecipe $recipe
     * @return WorkshopTask
     */
    public static function fromRecipe(WorkshopRecipe $recipe)
    {
        return app()->makeWith(WorkshopTask::class, ['recipe' => $recipe]);
    }
}
