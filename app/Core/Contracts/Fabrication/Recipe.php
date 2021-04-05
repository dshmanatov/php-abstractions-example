<?php

namespace App\Core\Contracts\Fabrication;

/**
 * Interface Recipe
 *
 * @package App\Core\Contracts\Fabrication
 */
interface Recipe
{
    /**
     * Get a list of items needed by a recipe
     *
     * @return mixed
     */
    public function getItems();
}
