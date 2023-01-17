<?php

use Illuminate\Support\Facades\Route;
use webit_be\developer_alert\app\Http\Controllers\DashboardController;
use webit_be\developer_alert\app\Http\Controllers\AlertController;

// Dashboard
Route::get('/developer-alert/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Alert settings
Route::get('/developer-alert/alert/settings/{id}', [AlertController::class, 'index'])->name('alert.snooze');
Route::post('/developer-alert/alert/settings/{id}', [AlertController::class, 'update'])->name('alert.update');
