<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\QueriesController;
use App\Http\Requests\QueriesRequest;
use Illuminate\Support\Facades\Route;


//Rutas de PrincipalController
Route::controller(MainController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/comercializacion', 'marketing')->name('marketing');
    Route::get('/terminos', 'terms')->name('terms');
    Route::get('/acerca-de', 'about')->name('about');
    Route::get('/contacto', 'contact')->name('contact');
    Route::get('/checkout', 'checkout')->name('checkout');
});

//Rutas de CatalogController
Route::controller(CatalogController::class)->group(function(){
    Route::get('/catalogo/{categoria?}', 'index')->name('catalog');
    Route::get('/producto-detalles/{id}', 'details')->name('product-details');
});

//Rutas de AuthController
Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::get('/signup', 'signup')->name('signup');
});

//Rutas de QueriesController
Route::get('/consultas', [QueriesController::class, 'index'])->name('queries');
Route::post('/enviar-consulta',[QueriesController::class, 'query_store']) ->name('queries.send');
