<?php

namespace App\Http\Controllers\Api;

use App\Models\Workshop;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class WorkshopsController extends Controller
{
    use DisableAuthorization;

    protected $model = Workshop::class;
}
