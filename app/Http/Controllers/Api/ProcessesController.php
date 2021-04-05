<?php

namespace App\Http\Controllers\Api;

use App\Core\Contracts\Logging\BufferedLogger;
use App\Logic\FabricationBuilder;
use App\Models\Resource;
use App\Models\Workshop;

class ProcessesController extends Controller
{
    public function create(FabricationBuilder $fabricationBuilder, BufferedLogger $logger)
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
