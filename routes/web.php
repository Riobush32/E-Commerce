<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class,'index'])->name('home');
Route::get('/detail-product/{id}', [ProductController::class,'productDetails'])->name('productDetails');
Route::post('/detail-product', [ProductController::class, 'addToCart'])->name('addToCart');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{id}/', [CartController::class, 'destroy'])->name('cartDestroy');

Route::get('/detail-product', function () {
    return view('page.detailProduct.index');
});


Route::get('/dashboard', function () {
    return view('page.admin.dashboard.index');
});



