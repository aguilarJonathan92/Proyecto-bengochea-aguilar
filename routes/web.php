<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

//RUTAS ACCESIBLES A TODOS
// Accesos sencillos
Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/comercializacion', 'marketing')->name('marketing');
    Route::get('/terminos', 'terms')->name('terms');
    Route::get('/acerca-de', 'about')->name('about');
    Route::get('/contacto', 'contact')->name('contact');
});

// Manejo de catálogo (Los productos son manejados por Filament)
Route::controller(CatalogController::class)->group(function () {
    Route::get('/catalogo/{categoria?}', 'index')->name('catalog');
    Route::get('/producto-detalles/{id}', 'details')->name('product-details');
});

// Formulario de Consultas
Route::get('/consultas', [QueriesController::class, 'create'])->name('queries');
Route::post('/enviar-consulta', [QueriesController::class, 'store'])->name('queries.send');

// Búsquedas
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Autenticación - Solo para invitados
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    // Registro
    Route::get('/signup', 'create')->name('signup.create');
    Route::post('/signup', 'store')->name('signup.store');
    // Login
    Route::get('/login', 'show')->name('login');
    Route::post('/login', 'authenticate')->name('login.authenticate');
});


//RUTAS PROTEGIDAS - Inicio de sesión requerido
Route::middleware('auth')->group(function () {
    // Admin y Cliente pueden hacer logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // EXCLUSIVO PARA CLIENTES (redirige a administradores)
    Route::middleware('no.admin')->group(function () {
        Route::get('/panel-cliente', [MainController::class, 'userPanel']);
        Route::get('/checkout', [MainController::class, 'checkout'])->name('checkout');
    });
});

// 3. FALLBACK (404 personalizado)=
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
