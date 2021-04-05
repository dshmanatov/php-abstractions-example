<?php
namespace App\Contracts;

interface TimelineInterval
{
    public function getStart();

    public function setDuration($duration);

    public function getDuration();

    /**
     * @return self
     */
    public function getNext();

    /**
     * @return int
     */
    public function getPosition();
}
