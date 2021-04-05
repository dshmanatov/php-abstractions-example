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
     * Get a list of resources needed by a recipe
     *
     * @return mixed
     */
    public function getResources();
}
