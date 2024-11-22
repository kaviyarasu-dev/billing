<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('products', ProductController::class)->only('show');
Route::post('billing/generate', [HomeController::class, 'generateBill'])->name('billing.generate');
