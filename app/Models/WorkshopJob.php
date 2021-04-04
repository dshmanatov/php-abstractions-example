<?php
namespace App\Models;

use App\Contracts\TimelineJob;

class WorkshopJob implements TimelineJob
{
    private $workshop;

    private $receipt;

    private $duration;

    private $start;

    public function __construct(Workshop $workshop, $receipt, $start)
    {
        $this->workshop = $workshop;
        $this->receipt = $receipt;
        $this->start = $start;
        $this->duration = rand(1, 4);
    }

    public function getWorkshop()
    {
        return $this->workshop;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getEnd()
    {
        return $this->getStart() + $this->getDuration();
    }

    public function __toString()
    {
        return "{$this->workshop->getName()} starts at {$this->getStart()} end before {$this->getEnd()}";
    }
}
