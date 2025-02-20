<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($id){
        return view('page.chat.index', [
            'to_user' => $id
        ]);
    }
}