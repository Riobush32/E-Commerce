<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class ComponentNavbarSearch extends Component
{
    public $products = array();
    public $search = "";
    public function updatingSearch()
    {
        $this->products = Product::where('name', 'LIKE', '%'. $this->search. '%')->get(); // Reset ke halaman pertama saat pencarian berubah
    }
    #[On('updateCartValue')]
    public function updateCartValue(){

    }
    public function search(){

    }
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