<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendVoucherController extends Controller
{
    public function index(){
        return view('backend.voucher.index', ['active' => 'Voucher']);
    }
}
