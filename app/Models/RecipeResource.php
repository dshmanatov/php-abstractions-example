<?php

namespace App\Models;

use App\Core\Contracts\Fabrication\RecipeItem;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RecipeResource
 *
 * @property integer $id
 * @property integer $quantity
 * @package App\Models
 */
class RecipeResource extends Model implements RecipeItem
{
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    /**
     * Get unique ID of the resource item
     *
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->resource->id;
    }

    /**
     * Get resource qty
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
