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
        //  Obtenemos las categorías activas, mandando el ID 1 al final
        // y ordenando las demás alfabéticamente por nombre.
        $categorias = Category::query()
            ->where('active', true)
            ->orderByRaw('id = 1 ASC')
            ->orderBy('name', 'asc')
            ->get();

        // Compartimos la misma colección optimizada con el Navbar y el Footer
        View::composer('components.navbar', function ($view) use ($categorias) {
            $view->with('categorias', $categorias);
        });

        View::composer('components.footer', function ($view) use ($categorias) {
            $view->with('categorias', $categorias);
        });
    }
}
