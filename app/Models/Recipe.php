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
class Recipe extends Model
{
    public $timestamps = false;

    public function resources()
    {
        // return $this->hasMany
    }
}
