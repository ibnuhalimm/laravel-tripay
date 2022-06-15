<?php

namespace Ibnuhalimm\LaravelTripay;

use Ibnuhalimm\LaravelTripay\Facades\Tripay;
use Ibnuhalimm\LaravelTripay\Requests\HttpClient;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TripayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-tripay.php'),
            ], 'laravel-tripay-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-tripay');

        // Register the main class to use with the facade
        $this->app->singleton(Tripay::class, function (Application $app) {
            return new Payment(
                $app->make(HttpClient::class)
            );
        });
    }
}
