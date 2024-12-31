<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\KeranjangController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

// Product Routes
Route::get('/products/scan/{code}', [ProductController::class, 'scanResult'])->name('products.scan');
Route::get('/products/search', [ProductController::class, 'manualSearch'])->name('products.search');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Keranjang Routes
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/add', [KeranjangController::class, 'add'])
    ->name('keranjang.add')
    ->withoutMiddleware([VerifyCsrfToken::class]);
Route::match(['get', 'post'], '/keranjang/remove/{id}', [KeranjangController::class, 'remove'])->name('keranjang.remove');
Route::match(['get', 'post'], '/keranjang/clear', [KeranjangController::class, 'clear'])->name('keranjang.clear');

require __DIR__.'/auth.php';
