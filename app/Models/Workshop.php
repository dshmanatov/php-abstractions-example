<?php

namespace App\Models;

use App\Core\Contracts\Fabrication\Producer;
use App\Traits\WorkshopTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Workshop
 *
 * @property integer             $id
 * @property string              $name
 * @property Collection|Recipe[] $recipes
 * @package App\Models
 */
class Workshop extends Model implements Producer
{
    use WorkshopTrait;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function getName()
    {
        return $this->name;
    }

    public function recipes()
    {
        return $this->hasMany(WorkshopRecipe::class);
    }

    /**
     * @inheritdoc
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}
