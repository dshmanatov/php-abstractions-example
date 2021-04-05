<?php
namespace App\Core\Contracts\Fabrication;

use Illuminate\Support\Collection;

/**
 * Interface Producer
 *
 * @package App\Core\Contracts\Fabrication
 */
interface Producer
{
    /**
     * @param Stock $warehouse
     * @return mixed
     */
    public function createTask(Stock $warehouse);

    /**
     * @return Collection|ProducerRecipe[]
     */
    public function getRecipes();
}
