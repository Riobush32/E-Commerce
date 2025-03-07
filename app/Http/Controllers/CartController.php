<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return view('page.cart.index');
        }
        return redirect()->back()->with(['warning' => 'kamu harus login terlebih dahulu']);
    }

    public function destroy($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with(['success' => 'data berhasil dihapus']);
    }
}
