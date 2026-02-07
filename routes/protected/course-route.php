<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('courses')->group(function () {

    // List courses with search, filters, sorting & pagination
    // /api/courses?search=physics&status=published&order_by=title&order_dir=asc
    Route::get('/', [CourseController::class, 'index']);
    Route::get('/{id}', [CourseController::class, 'show']);
    Route::get('/slug/{slug}', [CourseController::class, 'showBySlug']);
    Route::get('/instructor/{instructorId}', [CourseController::class, 'byInstructor']);
    Route::post('/', [CourseController::class, 'store']);
    Route::put('/{id}', [CourseController::class, 'update']);
    // Change course status (draft | published | archived)
    Route::patch('/{id}/status', [CourseController::class, 'changeStatus']);
    Route::delete('/{id}', [CourseController::class, 'destroy']);
});
