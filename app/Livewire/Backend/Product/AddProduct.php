<?php

namespace App\Livewire\Backend\Product;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;

class AddProduct extends Component
{
    public $name, $price, $category, $brand, $description = "", $info = "";

    #[On('setInfo')]
    public function setInfo($value)
    {
        $this->info = $value;
    }
    #[On('setDescription')]
    public function setDescription($value)
    {
        $this->description = $value;
    }
    public function saveNewProduct(){
        // dd($this->description);
        $this->validate([
            'name' => 'required|string|min:3',
            'price' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'description' => 'required',
            'info' => 'required'

        ]);
        Product::create([
            'name' => $this->name,
            'price' => str_replace('.', '', $this->price),
            'category_id' => $this->category,
            'brand_id' => $this->brand,
            'description' => $this->description,
            'info' => $this->info,

        ]);
        session()->flash('message', 'Produk berhasil disimpan!');
        $this->dispatch('updateProductList');
        $this->reset(); // Reset form setelah submit
    }
    public function render()
    {
        $brand = Brand::all();
        $category = Category::all();
        return view('livewire.backend.product.add-product', [
            'brands' => $brand,
            'categories' => $category,
        ]);
    }
}