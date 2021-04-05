<?php
namespace App\Contracts;

use App\Models\WorkshopRecipe;
use Illuminate\Support\Collection;

interface Workshop
{
    /**
     * @return string
     */
    public function getName();

    public function createTask(Warehouse $warehouse);

    /**
     * @return Collection|WorkshopRecipe[]
     */
    public function getRecipes();
}
