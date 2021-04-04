<?php

namespace App\Http\Controllers\Api;

use App\Models\Resource;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class ResourcesController extends Controller
{
    use DisableAuthorization;

    protected $model = Resource::class;
}
