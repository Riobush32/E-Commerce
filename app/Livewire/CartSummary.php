<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Summary;
use Livewire\Component;
use App\Models\Shipping;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CartSummary extends Component
{
    public $selectedItems = [];
    public $summary = [];
    public $count_data = 0;
    public $subtotal = 0;
    public $weight = 0;
    public $estimation = 0;
    public $discount = 0;
    public $payment = 0;
    public $shippingCost = 0;

    ////////////////////////////////////////////////////////////////
    public $check = null;
    public $shippingAddress;
    public $check_ongkir;
    public $ongkir;
    public $isShippingAddress;
    public $data_items_checkout;
    public $checkout = false;
    public $snapToken;
    public $snap;

    #[On('snap')]
    public function snap(){
        $this->snap = true;
    }
    #[On('pay')]
    public function pay()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-3X39MOPAb84SAKeuknSqUIRn';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $orderId = rand();

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $this->payment,
            ),
            'customer_details' => array(
                'first_name' => $this->shippingAddress->name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => $this->shippingAddress->no_hp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $this->snapToken = $snapToken;
        Summary::create([
            'snap_token' => $snapToken,
            'payment' => $this->payment,
            'orderid' => $orderId,
            'user_id' => Auth::user()->id,
            'shipping_id' => $this->shippingAddress->id,
            'shipping_cost' => $this->shippingCost,
            'discount' => $this->discount,
            'subtotal' => $this->subtotal,
            'weight' => $this->weight,
            'cart_selected' => implode(';', $this->selectedItems),
            'estimations' => $this->estimation
        ]);
        $summary = Summary::where('user_id', Auth::user()->id)
                        ->where('snap_token', $this->snapToken)->first();
        return redirect()->route('payment', ['id' => $summary->id]);
    }

    #[On('checkout')]
    public function checkout()
    {
        if ($this->check_ongkir) {
            $user_id = Auth::user()->id;
            $this->shippingAddress = Shipping::where('user_id', $user_id)->first();
            $this->data_items_checkout = Cart::where('user_id', $user_id)->whereIn('id', $this->selectedItems)->get();
            $this->checkout = true;
        }
    }
    #[On('uncheckout')]
    public function uncheckout()
    {
        $this->checkout = false;
    }
    #[On('check_ongkir')]
    public function check_ongkir()
    {
        $user_id = Auth::user()->id;
        $shippingAddress = Shipping::where('user_id', $user_id)->first();
        $this->shippingAddress = $shippingAddress;
        if (!empty($shippingAddress) && $this->weight > 0) {
            $response = Http::withHeaders([
                'key' => '29ef8b4236d9895dcefb110e9bdf366b',
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => 15,
                'destination' => $shippingAddress->city_id,
                'weight' => number_format($this->weight * 1000,2),
                'courier' => 'jne',
            ]);
            // dd($this->shippingAddress->city_id);
            if ($response->successful()) {
                // dd('berhasil');

                $this->ongkir = $response['rajaongkir']['results'];
                $this->isShippingAddress = true;
                $this->check_ongkir = true;
                foreach ($this->ongkir as $courier) {
                    foreach ($courier['costs'] as $cost) {
                        $this->shippingCost = $cost['cost'][0]['value'];
                        $this->estimation = $cost['cost'][0]['etd'];
                        break;
                    }

                }
                $this->payment = $this->subtotal + $this->discount + $this->shippingCost;
            } else {
                // dd('gagal');
                $this->ongkir = ['name' => 'tidak ditemukan'];
                $this->isShippingAddress = false;
                $this->check_ongkir = false;
            }
            $this->check_ongkir = true;
        } else {
            $this->check_ongkir = false;
            $this->check = 'gagal';
        }
    }

    #[On('updateSelection')]
    public function updateSelection($selectedItems)
    {
        $this->selectedItems = $selectedItems;
        $user_id = Auth::user()->id;
        $summary = Cart::where('user_id', $user_id)->whereIn('id', $selectedItems);
        $this->summary = $summary->get();
        $this->count_data = $summary->count();

        // hitung subtotal
        $this->subtotal = 0;
        $weight = 0;
        foreach ($this->summary as $item) {
            $this->subtotal += $item->variant->product->price * $item->quantity;
            $weight += $item->variant->weight * $item->quantity;
        }
        $this->weight = $weight * 0.001;
    }
    #[On('cartUpdated')]
    public function cartUpdate()
    {
        $user_id = Auth::user()->id;
        $summary = Cart::where('user_id', $user_id)->whereIn('id', $this->selectedItems);
        $this->summary = $summary->get();
        $this->count_data = $summary->count();

        // hitung subtotal
        $this->subtotal = 0;
        $weight = 0;
        foreach ($this->summary as $item) {
            $this->subtotal += $item->variant->product->price * $item->quantity;
            $weight += $item->variant->weight * $item->quantity;
        }
        $this->weight = $weight * 0.001;
    }

    public function mount() {}

    public function render()
    {
        $user_id = Auth::user()->id;
        $shippingAddress = Shipping::where('user_id', $user_id)->first();
        if (!empty($shippingAddress)) {
            $this->isShippingAddress = true;
        } else {
            $this->isShippingAddress = false;
        }
        return view('livewire.cart-summary', [
            // 'isShippingAddress' => false,
            // 'shippingAddress' => $shippingAddress
        ]);
    }
}