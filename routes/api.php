<?php

use App\Http\Controllers\Api\PokemonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// devuelve la lista de pokemon
Route::get('/pokemon', [PokemonController::class, 'index']);

// devuelve un pokemon
Route::get('/pokemon/{id}', [PokemonController::class, 'show']);

// crear un pokemon
Route::post('/pokemon', [PokemonController::class, 'store']);

// actualizar todos los campos de un pokemon
Route::put('/pokemon/{id}', [PokemonController::class, 'update']);

// actualizar el parcialmente un pokemon
Route::patch('/pokemon/{id}', [PokemonController::class, 'updatePartial']);

// eliminar un pokemon
Route::delete('/pokemon/{id}', [PokemonController::class, 'destroy']);
