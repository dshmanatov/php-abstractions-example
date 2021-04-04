<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Resource
 *
 * @property int    $id
 * @property string $name
 * @package App\Models
 */
class Resource extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock',];

    public $timestamps = false;
}
