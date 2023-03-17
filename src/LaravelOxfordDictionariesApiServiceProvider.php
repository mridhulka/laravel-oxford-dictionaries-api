<?php

namespace Mridhulka\LaravelOxfordDictionariesApi;

use Illuminate\Support\ServiceProvider;

class LaravelOxfordDictionariesApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/oxfordapi.php' => config_path('oxfordapi.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../config/oxfordapi.php', 'oxfordapi');

        /* dd("test"); */
    }

    public function register()
    {
        /*     $this->app->singleton(LaravelOxfordDictionariesApi::class, function () {
                return new LaravelOxfordDictionariesApi();
            }); */
    }
}
