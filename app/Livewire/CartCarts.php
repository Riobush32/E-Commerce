<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCarts extends Component
{
    public function render()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->latest()->get();
        return view('livewire.cart-carts',[
            'carts' => $carts,
        ]);
    }
}
