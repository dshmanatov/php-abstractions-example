<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Workshop
 *
 * @property integer $id
 * @property string  $name
 * @package App\Models
 */
class Recipe extends Model implements \App\Core\Contracts\Fabrication\Recipe
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function resources()
    {
        return $this->hasMany(RecipeResource::class);
    }

    /**
     * Get a list of items needed by a recipe
     *
     * @return mixed
     */
    public function getItems()
    {
        return $this->resources;
    }
}
