<?php

namespace App\Http\Controllers\Api;

use App\Contracts\FabricationBuilder;
use App\Models\Resource;
use App\Models\Workshop;

class ProcessesController extends Controller
{
    public function create(FabricationBuilder $fabricationBuilder)
    {
        $fabrication = $fabricationBuilder
            ->addWorkshops(Workshop::all())
            ->addResources(Resource::all())
            ->build();

        /*
        $timeline = new Timeline();

        $workshops = collect(
            [
                new Workshop('Фабрика 1'),
                new Workshop('Фабрика 2'),
            ]
        );

        $manager = new Manager($timeline, $workshops, 10);

        foreach ($manager->steps() as $job) {
            echo "Job: {$job}\n";
        };
        */

        return response()->json([
            'data' => [
                'builder' => $fabrication,
                'dummy' => 'results'
            ]
        ]);
    }
}
