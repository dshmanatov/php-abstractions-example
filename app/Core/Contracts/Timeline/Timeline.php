<?php
namespace App\Core\Contracts\Timeline;

interface Timeline
{
    public function add(TimelineEntry $entry);
    public function isEmpty();
    public function next();
}
