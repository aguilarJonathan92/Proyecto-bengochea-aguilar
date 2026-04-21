<?php

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

Route::get('/catalogo', [CatalogController::class, 'index'])->name('catalog');

Route::get('/contacto', [ContactController::class, 'index'])->name('contact');

Route::get('/producto-detalles', [CatalogController::class, 'details'])->name('product-details');
