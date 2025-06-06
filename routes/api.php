<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PKLController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\IndustriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::apiResource('siswa', App\Http\Controllers\Api\SiswaController::class)
    ->middleware(['auth:sanctum', 'role:super_admin']);
Route::apiResource('guru', App\Http\Controllers\Api\GuruController::class)
    ->middleware(['auth:sanctum', 'role:super_admin']);

Route::apiResource('industri', IndustriController::class);
Route::apiResource('pkl', PKLController::class);