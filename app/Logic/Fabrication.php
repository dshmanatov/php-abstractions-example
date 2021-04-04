<?php
namespace App\Logic;

use App\Contracts\Workshop;
use Illuminate\Support\Collection;

class Fabrication implements \App\Contracts\Fabrication
{
    /**
     * @var \App\Contracts\Warehouse
     */
    private $warehouse;

    /**
     * @var Collection
     */
    private $workshops;

    /** @var \App\Contracts\Timeline */
    private $timeline;

    public function __construct($warehouse, $workshops, \App\Contracts\Timeline $timeline)
    {
        $this->warehouse = $warehouse;
        $this->workshops = $workshops;
        $this->timeline = $timeline;
    }


    /**
     * Creates a new workshop job in a timeline
     *
     * @param Workshop $workshop
     * @param int      $start
     */
    protected function createJob(Workshop $workshop, $start = 0)
    {
        // Try grabbing resources here

        $job = $workshop->createJob($this->warehouse);

        // Grab resources
        $this->timeline->addJob(
            $job,
            $start
        );
    }

    /**
     * @return \Generator
     */
    public function produce()
    {
        $this->workshops->each(function (Workshop $workshop) {
            $this->createJob($workshop);
        });

        echo "Created\n";exit;
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

    public function run()
    {
        $result = [];

        foreach ($this->produce() as $value) {
            $result[] = $value;
        }

        return $result;
    }
}
