<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shipping;
use App\Services\RajaOngkirService;
use Illuminate\Support\Facades\Http;

class CheckOngkir extends Component
{

    public $cart_id;
    public $cities = [];
    // public $origin = [];
    public $destination = [];
    public $weight;
    public $courier = '';
    public $ongkir = [];

    // Saving

    public $selectedIndex = null;
    public $selectedService = null;

    public $city = '';
    public $shipping_cost = '';
    public $estimation = '';
    public $service ='';
    public $address = '';


    public function mount(RajaOngkirService $rajaOngkir, $cart_id)
    {
        $this->cart_id = $cart_id;
        $response = Http::withHeaders([
            'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        ])->get('https://api.rajaongkir.com/starter/city');
        $this->cities = $response['rajaongkir']['results'];
    }

    public function updateWeight(){
        $response = Http::withHeaders([
            'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => 15,
            'destination' => $this->destination,
            'weight' => $this->weight,
            'courier' => $this->courier
        ]);
        if($response->successful()) {
            $this->ongkir = $response['rajaongkir']['results'];
        }else {
            $this->ongkir = ['name' => 'tidak ditemukan'];
        }
    }

    public function selectService($courier, $service, $cost, $etd)
    {
        // Simpan data yang dipilih ke properti publik Livewire
        $this->courier = $courier;
        $this->service = $service;
        $this->shipping_cost = $cost;
        $this->estimation = $etd;

        // Simpan langsung ke database (opsional)
        $this->save();
    }

    public function save()
    {
        Shipping::create([
            'cart_id' => $this->cart_id,
            'city' => $this->destination, // Gunakan kota tujuan
            'postal_code' => $this->postal_code ?? '', // Jika tersedia
            'shipping_cost' => $this->shipping_cost,
            'weight' => $this->weight,
            'courier' => $this->courier,
            'estimation' => $this->estimation,
            'service' => $this->service,
            'address' => $this->address,
        ]);

        // Reset input (opsional)
        $this->reset(['courier', 'service', 'shipping_cost', 'estimation']);
    }

    public function render()
    {
        return view('livewire.check-ongkir');
    }

}
