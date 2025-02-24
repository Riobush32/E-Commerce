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
        ])
        ->get();
        return view('backend.transaction.print' , [
            'transactions' => $transactions,
            'dari' => $startDate,
           'sampai' => $endDate
        ]);
    }
}