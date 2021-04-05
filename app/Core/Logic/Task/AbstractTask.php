<?php
namespace App\Core\Logic\Task;

use App\Core\Contracts\Behavioural\Durationable;
use App\Core\Contracts\Behavioural\Taskable;

/**
 * Class AbstractTask
 *
 * @package App\Core\Logic\Task
 */
abstract class AbstractTask implements Taskable, Durationable
{
    public function onCreate()
    {
        // TODO: Implement onCreate() method.
    }
}
