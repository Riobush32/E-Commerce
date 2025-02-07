<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CartItem extends Component
{

    public $cart;
    public $index;
    public $quantity;
    public $isSelected = [];



    public function mount($cart, $index )
    {
        $this->cart = $cart;
        $this->index = $index;
    }

    public function updateQuantity($cartId, $action)
    {
        $cart = Cart::find($cartId);
        if(!empty($cart)&& $cart->quantity >= 0 ){
            if($action == 'minus'){
                $cart->update([
                    'quantity' => $cart->quantity - 1
                ]);
            } elseif ($action == 'plus') {
                $cart->update([
                    'quantity' => $cart->quantity + 1
                ]);
            }
            // Dispatch event untuk memberitahukan pembaruan
            // sleep(2);
            $cart = Cart::find($cartId);
            $this->cart = $cart;
            $this->dispatch('cartUpdated');
            }
    }
    public function render()
    {
        return view('livewire.cart-item');
    }
}
