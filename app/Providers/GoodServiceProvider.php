<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GoodService;
use App\Services\ImageService;

class GoodServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GoodService::class, function($app) {
            $app->make(ImageService::class);
            return new GoodService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
