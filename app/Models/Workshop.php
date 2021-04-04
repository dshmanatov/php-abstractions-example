<?php

namespace App\Models;

use App\Contracts\RecipesAwareWorkshop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Workshop
 *
 * @property integer $id
 * @property string  $name
 * @package App\Models
 */
class Workshop extends Model implements RecipesAwareWorkshop
{
    public $timestamps = false;

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return "Фабрика {$this->getName()}";
    }

    /**
     * @return Collection
     */
    public function getRecipes()
    {
        // TODO: Implement getRecipes() method.
    }
}
