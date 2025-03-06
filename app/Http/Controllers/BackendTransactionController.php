<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BackendTransactionController extends Controller
{
    public function index(){
        return view('backend.transaction.index', ['active' => 'transaction']);
    }

    public function print(Request $re){
        $startDate = $re->dari;
        $endDate = $re->sampai;
        $transactions = Transaction::whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ])->with(['user', 'cart', 'summary'])
            ->latest()
            ->get()
            ->groupBy('order_number');

        return view('backend.transaction.print' , [
            'orders' => $transactions,
            'dari' => $startDate,
           'sampai' => $endDate
        ]);
    }
}