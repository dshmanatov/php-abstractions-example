<?php

namespace App\Logic;

use App\Contracts\PrettyDescription;
use App\Core\Logic\Timeline\AbstractTimelineInterval;

/**
 * Class TimelineInterval
 *
 * @package App\Logic
 */
class TimelineInterval extends AbstractTimelineInterval implements PrettyDescription
{
    public function __construct($start = 0, $duration = 0)
    {
        $this->start = $start;
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getPrettyDescription()
    {
        return "Позиция: {$this->getPosition()}";
    }
}
