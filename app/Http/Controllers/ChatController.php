<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($product_id = null){
        $to_user = User::where('role', 'admin')->first();
        return view('page.chat.index', [
            'to_user' => $to_user->id,
            'product_id' => $product_id,
        ]);
    }
}