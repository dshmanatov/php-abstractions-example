<?php

namespace App\Tasks;

use App\Contracts\Workshop;
use App\Contracts\WorkshopRecipe;
use App\Core\Types\AbstractDurationAwareTask;
use App\Types\Good;

class WorkshopTask extends AbstractDurationAwareTask
{
    private $recipe;

    public function __construct(WorkshopRecipe $recipe)
    {
        $this->recipe = $recipe;

        parent::__construct();
    }

    /**
     * @return Workshop
     */
    public function getWorkshop()
    {
        return $this->recipe->getWorkshop();
    }

    public function getDuration()
    {
        return $this->recipe->getDuration();
    }

    /**
     * @return Good
     */
    public function getResult()
    {
        return new Good($this->recipe->getName());
    }

    public function __toString()
    {
        return $this->recipe->getName() . ' (' . $this->recipe->getDuration() . ')';
    }
}
