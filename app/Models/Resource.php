<?php

namespace App\Models;

use App\Core\Contracts\Fabrication\StockableItem;
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

    /**
     * Get item stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Get item's unique ID
     *
     * @return int
     */
    public function getIdentity()
    {
        return $this->id;
    }

    /**
     * Increase qty in stock
     *
     * @param $quantity
     */
    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
    }

    /**
     * Decrease qty in stock
     *
     * @param $quantity
     */
    public function decreaseStock($quantity)
    {
        $this->stock -= $quantity;
    }
}
