<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;

class CartCarts extends Component
{
    // Menambahkan listener untuk menangkap event dari child
    #[On('cartUpdated')]
    public function cartUpdate()
    {
        $user_id = Auth::user()->id;
        $this->carts = Cart::where('user_id', $user_id)->where('status', 'cart')->get();
    }
    public $carts;
    public $selectedItems = [];
    public $shippment_name = '';
    public $shippment_service = '';
    public $shippment_cost ;
    public $shippment_estimation ='';

    public function mount()
    {
        $user_id = Auth::user()->id;
        $this->carts = Cart::where('user_id', $user_id)->where('status', 'cart')->get();
    }

    public function updateSelection(){
        $this->dispatch('updateSelection', selectedItems:$this->selectedItems);
    }


    public function updateShippment($shippment_cost, $shippment_name, $shippment_service, $shippment_estimation){
        $this->shippment_cost = $shippment_cost;
        $this->shippment_name = $shippment_name;
        $this->shippment_service = $shippment_service;
        $this->shippment_estimation = $shippment_estimation;

    }

    public function render()
    {
        $user_id = Auth::user()->id;
        $shippingAddress = Shipping::where('user_id', $user_id)->first();
        // if(!empty($shippingAddress)){
        //     $response = Http::withHeaders([
        //         'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        //     ])->post('https://api.rajaongkir.com/starter/cost', [
        //         'origin' => 15,
        //         'destination' => $shippingAddress->city_id,
        //         'weight' => 3,
        //         'courier' => 'jne'
        //     ]);
        //     if($response->successful()) {
        //         $ongkir = $response['rajaongkir']['results'];
        //     }else {
        //         $ongkir = ['name' => 'tidak ditemukan'];
        //     }
        //     return view('livewire.cart-carts', [
        //         'ongkir' => $ongkir,
        //         'carts' => $carts,
        //         'isShippingAddress' => true,
        //         'shippingAddress' => $shippingAddress
        //     ]);
        // }
        return view('livewire.cart-carts',[
            'isShippingAddress' => false,
            'shippingAddress' => $shippingAddress
        ]);
    }


}