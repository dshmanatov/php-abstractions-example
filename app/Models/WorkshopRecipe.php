<?php

namespace App\Models;

use App\Contracts\DurationAware;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkshopRecipe
 *
 * @property Recipe  $recipe
 * @property integer $duration
 * @package App\Models
 */
class WorkshopRecipe extends Model implements \App\Contracts\WorkshopRecipe
{
    public $timestamps = false;

    public function getDuration()
    {
        return $this->duration;
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function getResources()
    {
        return $this->recipe->resources;
    }
}
