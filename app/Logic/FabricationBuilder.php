<?php

namespace App\Logic;

use Illuminate\Support\Collection;

class FabricationBuilder implements \App\Contracts\FabricationBuilder
{
    private $workshops;

    private $resources;

    public function __construct()
    {
        $this->workshops = collect();
        $this->resources = collect();
    }

    /**
     * @inheritdoc
     */
    public function addWorkshops($workshops)
    {
        $this->workshops = $this->workshops->concat($workshops);

        return $this;
    }

    /**
     * @param Collection $resources
     * @return mixed
     */
    public function addResources($resources)
    {
        $this->resources = $this->resources->concat($resources);

        return $this;
    }

    public function build()
    {
        return app()->makeWith(\App\Contracts\Fabrication::class, [
            'workshops' => $this->workshops,
        ]);
    }
}
