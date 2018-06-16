<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavbarProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function() {
            // Maps a key (the menu's name) onto an icon, link and possibly submenu
            $backendNav = [
                'Desktop' => ['home', route('backend/index')],
                'New' => ['add', '#', [
                    'Post' => ['', route('backend/post/create')],
                    'Category' => ['', route('backend/category/create')]
                ]],
                'All' => ['list', '#', [
                    'Posts' => ['', route('backend/post/index')],
                    'Categories' => ['', route('backend/category/index')]
                ]],
                'Live website' => ['screen_share', route('frontend/index')],
                'Logout' => ['play_for_work', route('logout')]
            ];

            View::share('backendNavbar', $backendNav);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
