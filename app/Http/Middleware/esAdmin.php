<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verificamos si el usuario está autenticado
        // 2. Verificamos si su rol NO es cliente (suponiendo que cliente es ID 3)
        if (Auth::check() && in_array(Auth::user()->rol->name, ['admin', 'superadmin'])) {
            return $next($request);
        }
        // Si es un cliente o no está logueado, lo mandamos afuera
        return redirect('/')->with('error', 'No tienes permisos para acceder al área administrativa.');
    }
}
