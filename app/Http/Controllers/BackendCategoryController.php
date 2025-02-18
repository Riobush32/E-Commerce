<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendCategoryController extends Controller
{
    public function index(){
        return view('backend.category.index', ['active' => 'category']);
    }
}