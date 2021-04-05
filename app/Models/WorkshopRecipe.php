<?php

namespace App\Models;

use App\Core\Contracts\Fabrication\ProducerRecipe;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkshopRecipe
 *
 * @property Recipe   $recipe
 * @property Workshop $workshop
 * @property integer  $duration
 * @package App\Models
 */
class WorkshopRecipe extends Model implements ProducerRecipe
{
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->recipe->name;
    }

    /**
     * @inheritdoc
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @inheritdoc
     */
    public function getItems()
    {
        return $this->recipe->resources;
    }

    /**
     * @inheritdoc
     */
    public function getProducer()
    {
        return $this->workshop;
    }
}
