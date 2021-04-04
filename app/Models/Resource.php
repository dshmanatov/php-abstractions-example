<?php

namespace App\Models;

use App\Contracts\Stockable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resource
 *
 * @property int     $id
 * @property string  $name
 * @property integer $stock
 * @package App\Models
 */
class Resource extends Model implements Stockable
{
    use HasFactory;

    protected $fillable = ['name', 'stock',];

    public $timestamps = false;

    public function getStock()
    {
        return $this->stock;
    }
}
