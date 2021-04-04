<?php

namespace App\Providers;

use App\Logic\Fabrication;
use App\Logic\Timeline;
use App\Logic\Warehouse;
use App\ViewComposers\AppDataProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        \App\Contracts\Timeline::class    => Timeline::class,
        \App\Contracts\Warehouse::class   => Warehouse::class,
        \App\Contracts\Fabrication::class => Fabrication::class,
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
