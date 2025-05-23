<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $Banner = Product::latest()->get();
        return view('page.home.index', [
            'Banner' => $Banner
        ]);
    }

    public function allProduct(){
        return view('page.home.all-product');
    }

    public function productDetails($id){
        $product = Product::find($id);
        $coments = Coment::where('product_id', $id)->get();
        return view('page.detailProduct.index',[
            'product' => $product,
            'coments' => $coments
        ]);
    }

    public function addToCart(Request $request){
        if(!$request->user_id){
            return redirect()->back()->with(['warning' => 'kamu harus login terlebih dahulu']);
        }else{
            if(!$request->variant){
                return redirect()->back()->with(['warning' => 'tolong pilih variant produk']);
            }
            if(!$request->notes){
                Cart::create([
                    'user_id' => $request->user_id,
                    'variant_id' => $request->variant,
                    'quantity' => $request->quantity,
                ]);
            return redirect()->back()->with(['success' => 'berhasil memasukkan product ke cart']);

        }else if($request->notes){
                Cart::create([
                    'user_id' => $request->user_id,
                    'variant_id' => $request->variant,
                    'quantity' => $request->quantity,
                    'notes' => $request->notes,
                ]);
                return redirect()->back()->with(['success' => 'berhasil memasukkan product dan catatan ke cart']);

            }
        else{
                return redirect()->back()->with(['error' => 'ada kesalahan tidak dapat menambahkan data']);
            }
        }
    }


}