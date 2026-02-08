<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('quizzes')->group(function () {

    // Quiz
    Route::post('/', [QuizController::class, 'store']);

    // Questions
    Route::post('/questions', [QuizController::class, 'addQuestion']);

    // Attempts
    Route::post('/{quiz}/start', [QuizController::class, 'startAttempt']);
    Route::post('/{quiz}/submit', [QuizController::class, 'submit']);
    Route::get('/{quiz}/attempts', [QuizController::class, 'attempts']);

});
