<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ComponentNavbarSearch extends Component
{
    public function render()
    {
        $categories = Category::latest()->get();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cart = Cart::where('user_id', $user_id)->where('status', 'cart')->get()->count();
            return view('livewire.component-navbar-search', [
                'categories' => $categories,
                'cart' => $cart,
            ]);
        }
        return view('livewire.component-navbar-search', [
            'categories' => $categories,
            'cart' => 0,
        ]);
    }
}