<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendChat extends Controller
{
    public function index(){
        return view('backend.chat.index', ['active' => 'Chat']);
    }
}
