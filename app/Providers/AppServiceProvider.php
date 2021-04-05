<?php

namespace App\Providers;

use App\Core\Logic\Timeline\PriorityTimeline;
use App\Logic\Fabrication;
use App\Logic\Timeline;
use App\Logic\Warehouse;
use App\Models\WorkshopJob;
use App\ViewComposers\AppDataProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        \App\Contracts\Timeline::class     => PriorityTimeline::class,
        \App\Contracts\Warehouse::class    => Warehouse::class,
        \App\Contracts\Fabrication::class  => Fabrication::class,
        \App\Contracts\WorkshopTask::class => WorkshopJob::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout.app', AppDataProvider::class);
    }
}
