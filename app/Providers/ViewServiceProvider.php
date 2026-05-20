<?php

namespace App\Providers;

use App\Models\Category;
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
        // Para el Navbar
        View::composer('components.navbar', function ($view) {
            $view->with('categorias', Category::query()->where('active', true)->get());
        });

        // Para el Footer
        View::composer('components.footer', function ($view) {
            $view->with('categorias', Category::query()->where('active', true)->get());
        });
    }
}
