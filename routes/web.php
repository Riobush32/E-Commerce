<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BackendBrandController;
use App\Http\Controllers\BackendProductController;
use App\Http\Controllers\BackendCategoryController;
use App\Http\Controllers\BackendTransactionController;

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

// Chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat');


Route::get('/dashboard', function () {
    return view('page.admin.dashboard.index');
});


//////////////////////////////////////////////////////////////////////////////////////////////
// Back End
// Route::get('/backend/product', [BackendProductController::class, 'index'])->name('backendProduct')->middleware([IsAdmin::class]);
Route::get('/backend/product', [BackendProductController::class, 'index'])->name('backendProduct');
Route::get('/backend/brand/', [BackendBrandController::class, 'index'])->name('backendBrand');
Route::get('/backend/category/', [BackendCategoryController::class, 'index'])->name('backendCategory');
Route::get('backend/transaction/', [BackendTransactionController::class, 'index'])->name('backendTransaction');