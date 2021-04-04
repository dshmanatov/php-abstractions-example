<?php

namespace App\Models;

use App\Contracts\DurationAware;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkshopRecipe
 *
 * @property integer $duration
 * @package App\Models
 */
class WorkshopRecipe extends Model implements DurationAware
{
    public function getDuration()
    {
        return $this->duration;
    }
}
