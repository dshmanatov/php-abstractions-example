<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface FabricationBuilder extends Builder
{
    /**
     * @param Collection|RecipesAwareWorkshop[] $workshops
     * @return mixed
     */
    public function addWorkshops($workshops);

    /**
     * @param Collection $resources
     * @return mixed
     */
    public function addResources($resources);
}
