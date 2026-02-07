<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
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

    

    Route::prefix('modules')->group(function () {        
        Route::get('/{id}', [ModuleController::class, 'show']);        
        Route::get('/course/{courseId}', [ModuleController::class, 'getByCourse']); 
        Route::post('/', [ModuleController::class, 'store']);         
        Route::put('/{id}', [ModuleController::class, 'update']);      
        Route::delete('/{id}', [ModuleController::class, 'destroy']); 
    });

});
