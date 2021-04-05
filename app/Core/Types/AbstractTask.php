<?php
namespace App\Core\Types;

use App\Contracts\Taskable;

abstract class AbstractTask implements Taskable
{
    public function __construct()
    {
        $this->onCreate();
    }

    public function onCreate()
    {
        // TODO: Implement onCreate() method.
    }
}
