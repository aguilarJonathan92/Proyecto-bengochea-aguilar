<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si está logueado y es admin, lo redirigimos a la ruta del panel de Filament o tu ruta admin
        if (Auth::check() && Auth::user()->role->name === 'admin') {
            return redirect('/admin');
        }

        return $next($request);
    }
}
