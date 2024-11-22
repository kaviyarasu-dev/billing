<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('products', ProductController::class)->only('show');

Route::prefix('billing')->as('billing.')->group(function () {
    Route::post('generate', [BillingController::class, 'generateBill'])->name('generate');
    Route::get('success/{order}', [BillingController::class, 'success'])->name('success');
});
