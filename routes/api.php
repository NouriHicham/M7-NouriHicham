<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PetsController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(IsUserAuth::class)->group(function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('pets', [PetsController::class, 'index']);
    Route::post('pets', [PetsController::class, 'store']);
    Route::put('pets/{id}', [PetsController::class, 'update']);
    Route::patch('pets/{id}', [PetsController::class, 'updatePartial']);
    Route::delete('pets/{id}', [PetsController::class, 'destroy']);
});

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('users/{id}/pets', [PetsController::class, 'userPets']);
    Route::get('users', [AuthController::class, 'allUsers']);
    Route::get('users/{id}', [AuthController::class, 'showUser']);
    Route::put('users/{id}', [AuthController::class, 'updateUser']);
    Route::delete('users/{id}', [AuthController::class, 'deleteUser']);
});
