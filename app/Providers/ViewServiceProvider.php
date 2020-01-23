<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class ViewServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**/
        $this->app->singleton("Twig", function ($app){
            $loader = new FilesystemLoader(resource_path("templates"));
            $twig = new Environment($loader, [
                'debug' => true,
                #'cache' => resource_path("templates")."/cache",
                'cache' => false
            ]);

            return $twig;
        });

    }

    /**
     * Get the sevices provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ["Twig"];
    }
}
