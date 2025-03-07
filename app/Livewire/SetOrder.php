<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Variant;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SetOrder extends Component
{
    public $productData;
    public $variantData = [], $variantId;
    public $quantity = 1;
    public $notes = "";

    public function mount($id){
        $this->productData = Product::find($id);
    }
///////////////////////// Quantity ///////////////////////////////////
    public function incrementQuantity(){
        $this->quantity++;
    }
    public function decrementQuantity(){
        if($this->quantity > 1){
            $this->quantity--;
        }
    }
//////////////////////// Quantity /////////////////////////////////////
//////////////////////// Add To cart////////////////////////////////////////
    public function setVariantData($id){
        $this->variantData = Variant::find($id);
    }
    public function addToCart($id = null){
        if ($id !== null) {
        if (Auth::check()) { // Periksa apakah pengguna sudah login
            Cart::create([
                'user_id' => Auth::user()->id,
                'variant_id' => $id,
                'status' => "cart",
                'quantity' => $this->quantity,
                'notes' => $this->notes,
            ]);
            
            $this->reset('variantData');
            $this->reset('variantId');
            $this->dispatch('updateCartValue');
            session()->flash('message', 'Berhasil disimpan ke keranjang!');
        } else {
            session()->flash('message', 'Kamu Harus Login Terlebih Dahulu!');
        }
    }
    }
//////////////////////// Add To cart////////////////////////////////////////
    public function render()
    {
        return view('livewire.set-order');
    }
}
