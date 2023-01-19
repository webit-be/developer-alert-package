<?php

use Illuminate\Support\Facades\Route;
use webit_be\developer_alert\app\Http\Controllers\DashboardController;
use webit_be\developer_alert\app\Http\Controllers\AlertController;

// Dashboard
Route::get('/developer-alert/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Alert settings
Route::get('/developer-alert/alert/settings/{id}', [AlertController::class, 'index'])->name('alert.settings');
Route::post('/developer-alert/alert/settings/{id}', [AlertController::class, 'update'])->name('alert.update');

Route::get('/developer-alert/alert/solve/{id}', [AlertController::class, 'solve'])->name('alert.solve');
Route::get('/developer-alert/alert/solve/prompt/{id}', [AlertController::class, 'prompt'])->name('alert.prompt');

// Route::post('/developer-alert/alert/solve/{id}', [AlertController::class, 'update'])->name('alert.solve.update');
