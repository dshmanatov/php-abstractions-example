<?php
namespace App\Contracts;

use App\Models\WorkshopRecipe;
use Illuminate\Support\Collection;

interface Workshop
{
    public function createJob(Warehouse $warehouse);

    /**
     * @return Collection|WorkshopRecipe[]
     */
    public function getRecipes();
}
