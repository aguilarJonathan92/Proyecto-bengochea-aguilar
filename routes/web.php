<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/contacto', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/catalogo', function () {
    return view('pages.catalog');
})->name('catalog');

Route::get('/comercializacion', function () {
    return view('pages.marketing');
})->name('marketing');

Route::get('/consultas', function () {
    return view('pages.queries');
})->name('queries');

Route::get('/terminos', function () {
    return view('pages.term-and-uses');
})->name('terms');

Route::get('/acerca-de', function () {
    return view('pages.about');
})->name('about');
