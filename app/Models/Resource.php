<?php

namespace App\Models;

use App\Contracts\StockableItem;
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
class Resource extends Model implements StockableItem
{
    use HasFactory;

    protected $fillable = ['name', 'stock',];

    public $timestamps = false;

    public function getStock()
    {
        return $this->stock;
    }

    public function getUniqueId()
    {
        return $this->id;
    }

    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
    }

    public function decreaseStock($quantity)
    {
        $this->stock -= $quantity;
    }
}
