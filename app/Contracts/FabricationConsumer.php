<?php
namespace App\Contracts;

use App\Core\Contracts\Fabrication\Consumer;
use Illuminate\Contracts\Support\Arrayable;

interface FabricationConsumer extends Consumer, Arrayable
{
}
