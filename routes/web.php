<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\KeranjangController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// Product Routes
Route::get('/products/scan/{code}', [ProductController::class, 'scanResult'])->name('products.scan');
Route::get('/products/search', [ProductController::class, 'manualSearch'])->name('products.search');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Keranjang Routes
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/add', [KeranjangController::class, 'add'])
    ->name('keranjang.add')
    ->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/keranjang/remove', [KeranjangController::class, 'remove'])
    ->name('keranjang.remove')
    ->withoutMiddleware([VerifyCsrfToken::class]);
Route::match(['get', 'post'], '/keranjang/clear', [KeranjangController::class, 'clear'])
    ->name('keranjang.clear')
    ->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/keranjang/update', [KeranjangController::class, 'update'])
    ->name('keranjang.update')
    ->middleware(['web'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

// Checkout Routes
Route::get('/checkout', function() {
    return view('checkout.index', [
        'items' => session('keranjang', []),
        'total' => collect(session('keranjang', []))->sum(function($item) {
            return $item['price'] * $item['quantity'];
        })
    ]);
})->name('checkout.index');

Route::post('/checkout/process', function(Request $request) {
    // Proses checkout
    // TODO: Simpan ke database
    
    // Kosongkan keranjang
    session()->forget('keranjang');
    
    return redirect()->route('homepage')->with('success', 'Pesanan berhasil diproses!');
})->name('checkout.process');

require __DIR__.'/auth.php';
