<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;




Route::prefix("v1")->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);
        Route::middleware('auth:sanctum')->post('/change-password', [AuthController::class, 'changePassword']);
        Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    });

    Route::prefix('notifications')->group(function () {
        Route::get('/{id}', [NotificationController::class, 'index']);
        Route::post('/', [NotificationController::class, 'store']);
        Route::post('/bulk', [NotificationController::class, 'bulk']);
        Route::patch('/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::patch('/read-all', [NotificationController::class, 'markAllAsRead']);
    });

    
    require __DIR__.'/protected/category-route.php';
    require __DIR__.'/protected/course-route.php';
    require __DIR__.'/protected/quiz-route.php';
    require __DIR__.'/protected/certificate-route.php';
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});