<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function index($cart_id){
        // $response = Http::withHeaders([
        //     'key' => '29ef8b4236d9895dcefb110e9bdf366b'
        // ])->get('https://api.rajaongkir.com/starter/city');
        // $cities = $response['rajaongkir']['results'];

        return view('page.check-ongkir.index', [
            'cart_id' => $cart_id
        ]);
    }
}

