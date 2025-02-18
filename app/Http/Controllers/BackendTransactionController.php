<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendTransactionController extends Controller
{
    public function index(){
        return view('backend.transaction.index', ['active' => 'transaction']);
    }
}