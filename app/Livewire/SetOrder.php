<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Summary;
use App\Models\Variant;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SetOrder extends Component
{
    public $productData;
    public $variantData = [], $variantId, $showMyVoucher=false, $voucherData = [];
    public $voucherSelected = '';
    public $discount = 0;
    public $voucherSelectedData = [];
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
    public function voucher(){
        $this->voucherData = UserVoucher::where('user_id',Auth::user()->id)->latest()->get();
        $this->showMyVoucher = true;
    }
    public function chooseVoucher($id){
        $this->voucherSelected = $id;
        $this->voucherSelectedData = Voucher::find($id);
        $this->showMyVoucher = false;
    }

    public function buyNow($id = null) {
        if ($id !== null) {
            $user_id = Auth::user()->id;
            if($this->voucherSelected !== ''){
                $voucher = Voucher::find($this->voucherSelected);
                if($voucher->valid_from <= Carbon::now() && $voucher->valid_until >= Carbon::now()){
                    if($voucher->discount_type == 'fixed'){
                        $this->discount = $voucher->discount_value;
                    } elseif($voucher->discount_type == 'percentage'){
                        $this->discount = $this->productData->price * $voucher->discount_value / 100;
                    }
                }else{
                    $this->discount = 0;
                }
            }else{
                $this->discount = 0;
            }
            $shipping = Shipping::where('user_id', $user_id)->first();
            if($shipping !== null) {

                if (Auth::check()) { // Periksa apakah pengguna sudah login
                    $data = Cart::create([
                        'user_id' => Auth::user()->id,
                        'variant_id' => $id,
                        'status' => "cart",
                        'quantity' => $this->quantity,
                        'notes' => $this->notes,
                    ]);

                    $dataId = $data->id;
                    $dataWeight = $data->variant->weight * $data->quantity;
                    $dataSubTotal = $data->variant->product->price * $data->quantity;
                    // dd($dataWeight);
                    if (!empty($shipping) && $dataWeight > 0) {
                        try {
                            $response = Http::withHeaders([
                                'key' => env('RAJAONGKIR_API_KEY'),
                            ])->post(env('RAJAONGKIR_API_URL'). 'cost', [
                                'origin' => 15,
                                'destination' => $shipping->city_id,
                                'weight' => number_format($dataWeight * 1000, 2),
                                'courier' => 'jne',
                            ]);

                            if ($response->successful()) {
                                $discount = $this->discount;
                                // dd('berhasil');

                                $ongkir = $response['rajaongkir']['results'];
                                $isShippingAddress = true;
                                foreach ($ongkir as $courier) {
                                    foreach ($courier['costs'] as $cost) {
                                        $shippingCost = $cost['cost'][0]['value'];
                                        $estimation = $cost['cost'][0]['etd'];
                                        break;
                                    }
                                }
                                $payment = ($dataSubTotal - $discount) + $shippingCost;
                                
                                // Set your Merchant Server Key
                                \Midtrans\Config::$serverKey = 'SB-Mid-server-3X39MOPAb84SAKeuknSqUIRn';
                                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                                \Midtrans\Config::$isProduction = false;
                                // Set sanitization on (default)
                                \Midtrans\Config::$isSanitized = true;
                                // Set 3DS transaction for credit card to true
                                \Midtrans\Config::$is3ds = true;
                                $orderId = rand();

                                $params = [
                                    'transaction_details' => [
                                        'order_id' => $orderId,
                                        'gross_amount' => $payment,
                                    ],
                                    'customer_details' => [
                                        'first_name' => $shipping->name,
                                        'last_name' => '',
                                        'email' => Auth::user()->email,
                                        'phone' => $shipping->no_hp,
                                    ],
                                ];

                                $snapToken = \Midtrans\Snap::getSnapToken($params);
                                Summary::create([
                                    'snap_token' => $snapToken,
                                    'payment' => $payment,
                                    'orderid' => $orderId,
                                    'user_id' => Auth::user()->id,
                                    'shipping_id' => $shipping->id,
                                    'shipping_cost' => $shippingCost,
                                    'discount' => $discount,
                                    'subtotal' => $dataSubTotal,
                                    'weight' => $dataWeight,
                                    'cart_selected' => $dataId,
                                    'estimations' => $estimation,
                                ]);
                                $summary = Summary::where('user_id', Auth::user()->id)
                                    ->where('snap_token', $snapToken)
                                    ->first();
                                if ($this->voucherSelected !== '') {
                                    $userVoucher = UserVoucher::where('user_id', Auth::user()->id)
                                        ->where('voucher_id', $this->voucherSelected)
                                        ->first();
                                    $userVoucher->delete();
                                }
                                return redirect()->route('payment', ['id' => $summary->id]);
                            } else {
                                dd("gagal");
                                $check_ongkir = false;
                            }
                        } catch (\Exception $e){
                            return [];
                        }

                    } else {
                        $check_ongkir = false;
                        $check = 'gagal';
                    }

                    
                    $this->reset('variantData');
                    $this->reset('variantId');
                    $this->dispatch('updateCartValue');
                    session()->flash('message', 'Berhasil disimpan ke keranjang!');
                } else {
                    session()->flash('message', 'Kamu Harus Login Terlebih Dahulu!');
                }
                
            } else {
                return redirect('/user-address/add');
            }
        }
    }
//////////////////////// Add To cart////////////////////////////////////////
    public function render()
    {
        return view('livewire.set-order');
    }
}
