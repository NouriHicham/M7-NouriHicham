<?php

use App\Http\Controllers\Api\PokemonController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// rutas publicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/pokemon', [PokemonController::class, 'index']);
Route::get('/pokemon/{id}', [PokemonController::class, 'show']);

// routes protegidas
Route::middleware([IsUserAuth::class])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('/pokemon', [PokemonController::class, 'store']);
});

//rutas admin
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('users', [AuthController::class, 'getUsers']);
    Route::get('user/{id}', [AuthController::class, 'getUser']);
    Route::put('user/{id}', [AuthController::class, 'updateUser']);
    Route::delete('user/{id}', [AuthController::class, 'deleteUser']);
    //pokemon
    Route::post('/pokemon', [PokemonController::class, 'store']);
    Route::put('/pokemon/{id}', [PokemonController::class, 'update']);
    Route::patch('/pokemon/{id}', [PokemonController::class, 'updatePartial']);
    Route::delete('/pokemon/{id}', [PokemonController::class, 'destroy']);

});
