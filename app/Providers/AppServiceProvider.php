<?php

namespace App\Providers;

use App\Core\Logging\BufferedLogger;
use App\Core\Logic\Timeline\PriorityTimeline;
use App\Logic\FabricationConsumer;
use App\Logic\Fabricator;
use App\Logic\Stock;
use App\ViewComposers\AppDataProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        \App\Core\Contracts\Timeline\Timeline::class      => PriorityTimeline::class,
        \App\Core\Contracts\Fabrication\Stock::class      => Stock::class,
        \App\Core\Contracts\Fabrication\Fabricator::class => Fabricator::class,
        \App\Core\Contracts\Logging\BufferedLogger::class => BufferedLogger::class,
        \App\Core\Contracts\Fabrication\Consumer::class   => FabricationConsumer::class,
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
