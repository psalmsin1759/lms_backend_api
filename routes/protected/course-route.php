<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
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


    Route::prefix('lessons')->group(function () {
        Route::get('/module/{moduleId}', [LessonController::class, 'index']);
        Route::get('/{id}', [LessonController::class, 'show']);
        Route::post('/', [LessonController::class, 'store']);
        Route::put('/{id}', [LessonController::class, 'update']);
        Route::delete('/{id}', [LessonController::class, 'destroy']);
    });

    Route::prefix('enrollments')->group(function () {
        Route::get('user/{userId}', [EnrollmentController::class, 'indexByUser']);
        Route::get('course/{courseId}', [EnrollmentController::class, 'indexByCourse']);
        Route::get('{id}', [EnrollmentController::class, 'show']);
        Route::post('/', [EnrollmentController::class, 'store']);
        Route::patch('{id}/status', [EnrollmentController::class, 'updateStatus']);
        Route::delete('{id}', [EnrollmentController::class, 'destroy']);
    });

});
