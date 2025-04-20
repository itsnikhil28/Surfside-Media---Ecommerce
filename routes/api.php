<?php

use App\Http\Controllers\GeminiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/gemini', [GeminiController::class, 'handle']);
Route::get('/gemini/last', [GeminiController::class, 'getLastResponse']);
