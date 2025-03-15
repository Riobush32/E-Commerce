<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        // Ambil semua transaksi, lalu kelompokkan berdasarkan order_number
        $transactions = Transaction::where('user_id', $user_id)->orderBy('order_number')->get()->groupBy('order_number');
        return view('page.transaction.index', [
            'transactions' => $transactions,
        ]);
    }

    public function updateStatus($order_number)
    {
        Transaction::where('order_number', $order_number)->update(['status' => '5']);
        return back();
    }

    public function coment(Request $re, $id, $transaction_id)
    {
        $transaction = Transaction::find($transaction_id);
        $coin = floor($transaction->summary->subtotal/1000);
        Coment::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'rating' => $re->rating,
            'coment' => $re->ulasan,
        ]);
        $user = User::find(Auth::user()->id);
        $poin = $user->poin + $coin;
        $user->update([
            'poin' => $poin
        ]);

        return back();
    }
}