<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Product Routes
Route::get('/products/scan/{code}', [ProductController::class, 'scanResult'])->name('products.scan');
Route::get('/products/search', [ProductController::class, 'manualSearch'])->name('products.search');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

require __DIR__.'/auth.php';
