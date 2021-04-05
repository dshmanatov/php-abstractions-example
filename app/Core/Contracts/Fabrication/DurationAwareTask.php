<?php

namespace App\Core\Contracts\Fabrication;

use App\Core\Contracts\Behavioural\Durationable;
use App\Core\Contracts\Behavioural\Taskable;

/**
 * Interface DurationAwareTask
 *
 * @package App\Contracts\Fabrication
 */
interface DurationAwareTask extends Taskable, Durationable
{
}
