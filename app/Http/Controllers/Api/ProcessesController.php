<?php

namespace App\Http\Controllers\Api;

use App\Logic\FabricationBuilder;
use App\Models\Recipe;
use App\Models\Resource;
use App\Models\Workshop;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

class ProcessesController extends Controller
{
    public function create(FabricationBuilder $fabricationBuilder)
    {
        $fabrication = $fabricationBuilder
            ->setWarehouse(Resource::all())
            ->setWorkshops(Workshop::all())
            ->build();

        $result = $fabrication->run();

        return response()->json([
            'data' => [
                'data' => $result,
            ]
        ]);
    }
}
