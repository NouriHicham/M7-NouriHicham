<?php

use App\Http\Controllers\PeliculasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('peliculas', PeliculasController::class);
