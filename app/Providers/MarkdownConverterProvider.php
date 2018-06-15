<?php

namespace App\Providers;

use App\System\MarkdownConverter;
use Illuminate\Support\ServiceProvider;

class MarkdownConverterProvider extends ServiceProvider
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
        $this->app->register('System\MarkdownConverter', function($app) {
            return new MarkdownConverter();
        });
    }
}
