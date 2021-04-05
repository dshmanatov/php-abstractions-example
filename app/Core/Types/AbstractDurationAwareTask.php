<?php
namespace App\Core\Types;

use App\Contracts\DurationAware;

abstract class AbstractDurationAwareTask extends AbstractTask implements DurationAware
{
}
