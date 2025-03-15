<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\BackendChat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BackendBrandController;
use App\Http\Controllers\BackendProductController;
use App\Http\Controllers\BackendVoucherController;
use App\Http\Controllers\BackendCategoryController;
use App\Http\Controllers\BackendDashboardController;
use App\Http\Controllers\BackendTransactionController;

Route::get('/', [ProductController::class,'index'])->name('home');
Route::get('/all-product', [ProductController::class,'allProduct'])->name('allProduct');
Route::get('/detail-product/{id}', [ProductController::class,'productDetails'])->name('productDetails');
Route::post('/detail-product', [ProductController::class, 'addToCart'])->name('addToCart')->middleware('auth');

Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::delete('/cart/{id}/', [CartController::class, 'destroy'])->name('cartDestroy')->middleware('auth');
Route::get('/shipping/{cart_id}', [ShippingController::class, 'index'])->name('shipping')->middleware('auth');

Route::get('/user-address', [ShippingController::class, 'index'])->name('shippingAddress')->middleware('auth');
Route::get('/user-address/add',[ShippingController::class, 'add'])->name('addShippingAddress')->middleware('auth');
Route::post('/user-address/store',[ShippingController::class, 'store'])->name('storeShippingAddress')->middleware('auth');
Route::get('/user-address/edit/{id}',[ShippingController::class, 'edit'])->name('editShippingAddress')->middleware('auth');
Route::patch('/user-address/update',[ShippingController::class, 'update'])->name('updateShippingAddress')->middleware('auth');

//check ongkir
Route::get('cek-ongkir/{cart_id}', [RajaOngkirController::class, 'index'])->name('shipping')->middleware('auth');
Route::get('payment/{id}', [PaymentController::class, 'index'])->name('payment')->middleware('auth');
Route::get('/checkout/succses/{id}', [PaymentController::class, 'checkoutSuccess'])->name('checkoutSuccses')->middleware('auth');


Route::get('/transaction', [TransactionController::class, 'index'])->name('transactionList')->middleware('auth');
Route::post('/transaction/coment/{id}/{transaction}', [TransactionController::class, 'coment'])->name('transactionComent')->middleware('auth');
Route::get('/transaction/{order_number}', [TransactionController::class, 'updateStatus'])->name('transactionUpdateStatus')->middleware('auth');
Route::get('/detail-product', function () {
    return view('page.detailProduct.index');
});

// Chat
Route::get('/chat/{id?}', [ChatController::class, 'index'])->name('chat')->middleware('auth');

//voucher
Route::get('/voucher', [VoucherController::class, 'index'])->name('getVoucher')->middleware('auth');
Route::post('/voucher/buy/{id}', [VoucherController::class, 'buy'])->name('buyVoucher')->middleware('auth');
Route::get('voucher/my-voucher', [VoucherController::class, 'myVoucher'])->name('myVoucher')->middleware('auth');


Route::get('/dashboard', function () {
    return view('page.admin.dashboard.index');
});


//////////////////////////////////////////////////////////////////////////////////////////////
// Back End
// Route::get('/backend/product', [BackendProductController::class, 'index'])->name('backendProduct')->middleware([IsAdmin::class]);
Route::get('/backend/dashboard', [BackendDashboardController::class, 'index'])->name('backendDashboard')->middleware([IsAdmin::class]);
Route::get('/backend/product', [BackendProductController::class, 'index'])->name('backendProduct')->middleware([IsAdmin::class]);
Route::get('/backend/brand/', [BackendBrandController::class, 'index'])->name('backendBrand')->middleware([IsAdmin::class]);
Route::get('/backend/category/', [BackendCategoryController::class, 'index'])->name('backendCategory')->middleware([IsAdmin::class]);
Route::get('backend/transaction/', [BackendTransactionController::class, 'index'])->name('backendTransaction')->middleware([IsAdmin::class]);
Route::post('backend/transaction/print', [BackendTransactionController::class, 'print'])->name('backendTransactionPrint')->middleware([IsAdmin::class]);
Route::get('/backend/chat/', [BackendChat::class, 'index'])->name('backendChat')->middleware([IsAdmin::class]);
Route::get('/backend/voucher/', [BackendVoucherController::class, 'index'])->name('backendVoucher');
