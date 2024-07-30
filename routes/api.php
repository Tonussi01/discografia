<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscoController;
use App\Http\Controllers\MusicaController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teste', function () {
    return "Api Funcional!";
});

Route::get('/disco',[DiscoController::class, 'index']);
Route::get('/disco/{id}',[DiscoController::class, 'show']);
Route::post('/disco',[DiscoController::class, 'store']);
Route::put('/disco/{id}',[DiscoController::class, 'update']);
Route::delete('/disco/{id}',[DiscoController::class, 'destroy']);

Route::apiResource('discos', DiscoController::class);
Route::apiResource('musicas', MusicaController::class);

