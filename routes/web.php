<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('page.home.index');
});

Route::get('/detail-product', function () {
    return view('page.detailProduct.index');
});

Route::get('/cart', function () {
    return view('page.cart.index');
});

Route::get('/dashboard', function () {
    return view('page.admin.dashboard.index');
});



