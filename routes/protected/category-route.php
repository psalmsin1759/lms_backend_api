<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/tree', [CategoryController::class, 'tree']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::patch('/{id}/toggle', [CategoryController::class, 'toggle']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});
