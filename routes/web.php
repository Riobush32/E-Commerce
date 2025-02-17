<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BackendProductController;

Route::get('/', [ProductController::class,'index'])->name('home');
Route::get('/detail-product/{id}', [ProductController::class,'productDetails'])->name('productDetails');
Route::post('/detail-product', [ProductController::class, 'addToCart'])->name('addToCart');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{id}/', [CartController::class, 'destroy'])->name('cartDestroy');
Route::get('/shipping/{cart_id}', [ShippingController::class, 'index'])->name('shipping');

Route::get('/user-address', [ShippingController::class, 'index'])->name('shippingAddress');
Route::get('/user-address/add',[ShippingController::class, 'add'])->name('addShippingAddress');
Route::post('/user-address/store',[ShippingController::class, 'store'])->name('storeShippingAddress');
Route::get('/user-address/edit/{id}',[ShippingController::class, 'edit'])->name('editShippingAddress');
Route::patch('/user-address/update',[ShippingController::class, 'update'])->name('updateShippingAddress');

//check ongkir
Route::get('cek-ongkir/{cart_id}', [RajaOngkirController::class, 'index'])->name('shipping');
Route::get('payment/{id}', [PaymentController::class, 'index'])->name('payment');
Route::get('/checkout/succses/{id}', [PaymentController::class, 'checkoutSuccess'])->name('checkoutSuccses');


Route::get('/transaction', [TransactionController::class, 'index'])->name('transactionList');
Route::get('/detail-product', function () {
    return view('page.detailProduct.index');
});


Route::get('/dashboard', function () {
    return view('page.admin.dashboard.index');
});


//////////////////////////////////////////////////////////////////////////////////////////////
// Back End
Route::get('/backend/product-list', [BackendProductController::class, 'index'])->name('backendProductList');
Route::get('/backend/product-list/add', [BackendProductController::class, 'add'])->name('backendProductList');