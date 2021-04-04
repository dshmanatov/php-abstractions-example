<?php

namespace App\Http\Controllers\Api;

use App\Logic\FabricationBuilder;
use App\Models\Recipe;
use App\Models\Resource;
use App\Models\Workshop;

class ProcessesController extends Controller
{
    public function create(FabricationBuilder $fabricationBuilder)
    {
        $fabrication = $fabricationBuilder
            ->setWarehouse(Resource::all())
            ->setWorkshops(Workshop::all())
            ->build();

        $fabrication->run();

        return response()->json([
            'data' => [
                'data' => $fabrication,
                'dummy' => 'results'
            ]
        ]);
    }
}
