<?php

namespace App\Logic;

use App\Models\Workshop;
use App\Models\WorkshopJob;
use Illuminate\Support\Collection;

class Manager
{
    /** @var \App\Contracts\Timeline $timeline */
    private $timeline;

    /** @var Collection */
    private $workshops;

    private $resources;

    public function __construct(\App\Contracts\Timeline $timeline, $workshops, $resources)
    {
        $this->timeline = $timeline;
        $this->workshops = $workshops;
        $this->resources = $resources;
    }

    /**
     * Creates a new workshop job in a timeline
     *
     * @param Workshop $workshop
     * @param int      $start
     */
    protected function createJob(Workshop $workshop, $start = 0)
    {
        if (--$this->resources < 0) {
            return;
        }

        $job = new WorkshopJob($workshop, "JOB", $start);

        // Grab resources
        $this->timeline->addJob(
            $job
        );
    }

    /**
     * @return \Generator
     */
    public function steps()
    {
        $this->workshops->each(function (Workshop $workshop) {
            $this->createJob($workshop);
        });

        /** @var WorkshopJob $job */
        while ($job = $this->timeline->extractJob()) {
            yield $job;

            // Create new job
            $this->createJob(
                $job->getWorkshop(),
                $job->getStart() + $job->getDuration()
            );
        }
    }
}
