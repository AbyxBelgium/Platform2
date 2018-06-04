<?php

namespace App\Providers;

use App\Managers\LinuxSystemResourceManager;
use App\Managers\WindowsSystemResourceManager;
use Illuminate\Support\ServiceProvider;

class SystemResourceProvider extends ServiceProvider
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
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->app->bind('App\Managers\SystemResourceManager', function($app) {
                return new WindowsSystemResourceManager();
            });
        } else {
            $this->app->bind('App\Managers\SystemResourceManager', function($app) {
                return new LinuxSystemResourceManager();
            });
        }
    }
}
