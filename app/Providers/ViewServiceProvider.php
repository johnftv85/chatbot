<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::share('prueba','Este es un mensaje desde el show');

        View::composer(['posts.show','posts.index'], function ($view) {
            $view->with('prueba2', 'Este es un mensaje desde el show2');
        });
    }
}
