<?php
namespace App\Contracts;

interface Timeline
{
    public function addJob(TimelineJob $job);
    public function hasJobs();
    public function extractJob();
}
