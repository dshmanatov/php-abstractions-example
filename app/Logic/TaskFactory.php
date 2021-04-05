<?php

namespace App\Logic;

use App\Core\Contracts\Fabrication\Recipe;
use App\Tasks\WorkshopTask;

/**
 * Class TaskFactory
 *
 * @package App\Logic
 */
class TaskFactory
{
    /**
     * Create concrete class instance
     *
     * @param $recipe
     * @return WorkshopTask
     */
    public static function fromRecipe(Recipe $recipe)
    {
        return app()->makeWith(WorkshopTask::class, ['recipe' => $recipe]);
    }
}
