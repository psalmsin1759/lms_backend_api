<?php


use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::prefix('certificates')->group(function () {

    // Public verification
    Route::post('/verify', [CertificateController::class, 'verify']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/my', [CertificateController::class, 'myCertificates']);

        Route::post('/', [CertificateController::class, 'issue']);

        Route::post('/{id}/reissue', [CertificateController::class, 'reissue']);

        Route::delete('/{id}/revoke', [CertificateController::class, 'revoke']);
    });
});
