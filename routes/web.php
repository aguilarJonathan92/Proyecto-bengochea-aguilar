<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrincipalController::class, 'index'])->name('home');

Route::get('/comercializacion', [PrincipalController::class, 'marketing'])->name('marketing');

Route::get('/terminos', [PrincipalController::class, 'terms'])->name('terms');

Route::get('/acerca-de', [PrincipalController::class, 'about'])->name('about');

Route::get('/consultas', [QueriesController::class, 'index'])->name('queries');

Route::get('/catalogo/{categoria?}', [CatalogController::class, 'index'])->name('catalog');

Route::get('/contacto', [PrincipalController::class, 'contact'])->name('contact');

Route::get('/producto-detalles', [CatalogController::class, 'details'])->name('product-details');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

//falta crear el controlador para poner esta ruta
Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout');
