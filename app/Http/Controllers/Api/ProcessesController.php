<?php

namespace App\Http\Controllers\Api;

use App\Core\Contracts\Fabrication\Consumer;
use App\Core\Contracts\Logging\BufferedLogger;
use App\Logic\FabricationBuilder;
use App\Logic\FabricationConsumer;
use App\Models\Resource;
use App\Models\Workshop;

class ProcessesController extends Controller
{
    /**
     * @param FabricationBuilder           $fabricationBuilder
     * @param BufferedLogger               $logger
     * @param Consumer|FabricationConsumer $consumer
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(
        FabricationBuilder $fabricationBuilder,
        BufferedLogger $logger,
        FabricationConsumer $consumer
    )
    {
        $fabrication = $fabricationBuilder
            ->setStock(Resource::all())
            ->setProducers(Workshop::all())
            ->setLogger($logger)
            ->setConsumer($consumer)
            ->build();

        $fabrication->run();

        return response()->json([
            'data' => [
                'goods' => $consumer->toArray(),
                'log'   => $logger->toArray(),
            ]
        ]);
    }
}
