<?php

namespace App\Http\Controllers\Api;

use App\Logging\SimpleLogger;
use App\Logic\FabricationBuilder;
use App\Models\Resource;
use App\Models\Workshop;

class ProcessesController extends Controller
{
    public function create(FabricationBuilder $fabricationBuilder, SimpleLogger $logger)
    {
        $fabrication = $fabricationBuilder
            ->setWarehouse(Resource::all())
            ->setWorkshops(Workshop::all())
            ->setLogger($logger)
            ->build();

        $result = $fabrication->run();

        return response()->json([
            'data' => [
                'log'  => $logger->toArray(),
                'data' => $result,
            ]
        ]);
    }
}
