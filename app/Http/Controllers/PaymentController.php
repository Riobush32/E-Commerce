<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Summary;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index($id){
        $summary = Summary::find($id);
        return view('page.payment.index', [ 'summary' => $summary
        ]);
    }

    public function checkoutSuccess($id){
        $summary = Summary::find($id);
        $items = explode(";", $summary->cart_selected);

        Cart::whereIn('id', $items)->update(['status' => 'transaction']);

        $order_number = 'order-'.rand();
        foreach($items as $item){
            Transaction::create([
                'order_number' => $order_number,
                'user_id' => Auth::user()->id,
                'summary_id' => $summary->id,
                'cart_id' => $item,
                'status' => '1',
            ]);
        }
        return redirect()->route('transactionList');
    }
}