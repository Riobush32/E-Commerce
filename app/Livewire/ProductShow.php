<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    public function render()
    {
        $products = Product::latest()->paginate(8);
        return view('livewire.product-show', [
            'products' => $products,
        ]);
    }
}
