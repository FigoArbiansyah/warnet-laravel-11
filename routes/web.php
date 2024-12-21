<?php

use App\Http\Controllers\BillingRateController;
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

Route::prefix('billing-rates')->name('billing-rates.')->group(function () {
    Route::get('/', [BillingRateController::class, 'index'])->name('index');
    Route::put('/update/{id}', [BillingRateController::class, 'update'])->name('update');
});
