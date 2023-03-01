<?php

use Illuminate\Support\Facades\Route;
use webit_be\developer_alert\app\Http\Controllers\DashboardController;
use webit_be\developer_alert\app\Http\Controllers\AlertController;

Route::prefix('developer-alert')->group( function() {
    // Dashboard
    Route::prefix('/dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/download/logs', [DashboardController::class, 'downloadLogs'])->name('dashboard.download');
    });
    
    Route::prefix('/alert')->group(function() {
        // Alert settings
        Route::get('/settings/{id}', [AlertController::class, 'index'])->name('alert.settings');
        Route::post('/settings/{id}', [AlertController::class, 'update'])->name('alert.update');

        // Alert solve
        Route::get('/solve/{id}', [AlertController::class, 'solve'])->name('alert.solve');
        Route::post('/solve/prompt/{id}', [AlertController::class, 'prompt'])->name('alert.prompt');
    });
});

// Route::post('/developer-alert/alert/solve/{id}', [AlertController::class, 'update'])->name('alert.solve.update');
