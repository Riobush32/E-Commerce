<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $shippingAddress = Shipping::where('user_id', $user_id)->first();
        return view('page.shipping.index',[
            'shippingAddress' => $shippingAddress
        ]);
    }
    public function add(){
        $response = Http::withHeaders([
            'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        ])->get('https://api.rajaongkir.com/starter/city');

        $response2 = Http::withHeaders([
            'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response2['rajaongkir']['results'];
        $cities = $response['rajaongkir']['results'];
        return view('page.shipping.add', [
            'cities' => $cities,
            'provinces' => $provinces
        ]);
    }

    public function store(Request $request){
        $user_id = Auth::user()->id;
        $cities = explode(";", $request->city);
        $provinces = explode(";", $request->province);

        Shipping::create([
            'user_id' => $user_id,
            'name' => $request->nama,
            'no_hp' =>  $request->no_hp,
            'province' =>  $provinces[1],
            'province_id' =>  $provinces[0],
            'city_id' =>  $cities[0],
            'city_name' =>  $cities[1],
            'kecamatan' =>  $request->kecamatan,
            'kelurahan' =>  $request->kelurahan,
            'postal_code' =>  $request->kode_pos,
            'address' =>  $request->address,
        ]);

        return redirect()->back()->with(['success' => 'berhasil membuat shipping address']);
    }

    public function edit($id){
        $shippingAddress = Shipping::find($id);
        $response = Http::withHeaders([
            'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        ])->get('https://api.rajaongkir.com/starter/city');

        $response2 = Http::withHeaders([
            'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response2['rajaongkir']['results'];
        $cities = $response['rajaongkir']['results'];

        return view('page.shipping.edit', [
           'shippingAddress' => $shippingAddress,
            'cities' => $cities,
            'provinces' => $provinces
        ]);
    }

    public function update(Request $request){
        $shippingAddress = Shipping::find($request->id);
        $cities = explode(";", $request->city);
        $provinces = explode(";", $request->province);

        $shippingAddress->update([
            'name' => $request->nama,
            'no_hp' =>  $request->no_hp,
            'province' =>  $provinces[1],
            'province_id' =>  $provinces[0],
            'city_id' =>  $cities[0],
            'city_name' =>  $cities[1],
            'kecamatan' =>  $request->kecamatan,
            'kelurahan' =>  $request->kelurahan,
            'postal_code' =>  $request->kode_pos,
            'address' =>  $request->address,
        ]);
        return redirect()->route('shippingAddress')->with(['success' => 'berhasil mengubah shipping address']);
    }
}
