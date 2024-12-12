<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCarts extends Component
{
    public $carts;
    public $selectedItems = [];

    public function mount()
    {
        $user_id = Auth::user()->id;
        $this->carts = Cart::where('user_id', $user_id)->with('variant.product')->get();
    }
    public function updateQuantity($cartId, $quantity)
    {
        $cart = Cart::find($cartId);
        $user_id = Auth::user()->id;
        if ($quantity > 0 && $quantity <= $cart->variant->stock) {
            $cart->update(['quantity' => $quantity]);
            $this->carts = Cart::where('user_id', $user_id)->with('variant.product')->get();
        } else {
            session()->flash('warning', 'Quantity must be greater than 0');

        }
    }

    public function getSubtotalProperty()
    {
        return $this->carts
            ->where('user_id', Auth::user()->id)
            ->whereIn('id', $this->selectedItems)
            ->sum(function($cart) {
                return $cart->variant->product->price * $cart->quantity;
            });
    }

    public function render()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        return view('livewire.cart-carts',[
            'carts' => $carts,
        ]);
    }


}
