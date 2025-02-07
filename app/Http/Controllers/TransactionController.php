<?php

namespace App\Http\Controllers;

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
}