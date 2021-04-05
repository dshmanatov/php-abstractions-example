<?php
namespace App\Contracts;

interface Timeline
{
    public function add(TimelineEntry $entry);
    public function isEmpty();
    public function next();
}
