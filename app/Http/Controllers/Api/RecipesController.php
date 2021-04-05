<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class RecipesController extends Controller
{
    use DisableAuthorization;

    protected $model = Recipe::class;
}
