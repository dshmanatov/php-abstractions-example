<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RecipeResource
 *
 * @property integer $id
 * @property integer $quantity
 * @package App\Models
 */
class RecipeResource extends Model implements \App\Contracts\RecipeResource
{
    public $timestamps = false;

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function getUniqueId()
    {
        return $this->resource->id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}
