<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkshopRecipe
 *
 * @property Recipe   $recipe
 * @property Workshop $workshop
 * @property integer  $duration
 * @package App\Models
 */
class WorkshopRecipe extends Model implements \App\Contracts\WorkshopRecipe
{
    public $timestamps = false;

    public function getDuration()
    {
        return $this->duration;
    }

    public function getName()
    {
        return $this->recipe->name;
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function getResources()
    {
        return $this->recipe->resources;
    }

    /**
     * @return \App\Contracts\Workshop
     */
    public function getWorkshop()
    {
        return $this->workshop;
    }
}
