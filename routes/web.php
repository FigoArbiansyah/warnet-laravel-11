<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);

Route::prefix('computers')->name('computers.')->group(function () {
    Route::get('/', [ComputerController::class, 'index'])->name('index');
    Route::post('/store', [ComputerController::class, 'store'])->name('store');
    Route::post('/update/{id}', [ComputerController::class, 'update'])->name('update');
    Route::post('/update-status/{id}', [ComputerController::class, 'updateStatus'])->name('update-status');
});
