<?php

namespace App\Providers;

use App\Managers\IconManager;
use Illuminate\Support\ServiceProvider;

class IconProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Managers\IconManager', function($app) {
            return new IconManager();
        });
    }
}
