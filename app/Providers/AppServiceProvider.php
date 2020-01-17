<?php

namespace App\Providers;

use App\Http\Data\BoardInterface;
use App\Http\Service\BoardService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        // Board Interface Bind
        BoardInterface::class => BoardService::class

    ];
    public $singletons = [
        // Board Interface singletons
        // BoardInterface::class => BoardService::class

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
        //
    }
}
