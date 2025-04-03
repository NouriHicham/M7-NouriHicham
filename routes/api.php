<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class, 'index']);

Route::get('/students/{id}', [StudentController::class, 'show']);

Route::post('/students', function (Request $request) {
    return "Estudiante creado con éxito";
});

Route::put('/students/{id}', function (Request $request){
    return "Estudiante actualizado con éxito";
});

Route::delete('/students/{id}', function (Request $request){
    return "Estudiante eliminado con éxito";
});

Route::patch('/students/{id}', function (Request $request){
    return "Estudiante actualizado parcialmente con éxito";
});
