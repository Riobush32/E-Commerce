<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendBrandController extends Controller
{
    public function index(){
        return view('backend.brand.index', ['active' => 'brand']);
    }
}