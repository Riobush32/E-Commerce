<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BackendDashboardController extends Controller
{
    public function index()
    {
        $statusTransaksi = ['diProses', 'dipacking', 'diKirim', 'diTerima', 'selesai'];

        $jumlahTransaksi = [];
        for ($i = 1; $i <= 5; $i++) {
            $jumlahTransaksi[] = Transaction::where('status', $i)->count();
        }

        $year = 2025; // Tahun yang diinginkan

        // Membuat array untuk semua bulan dalam satu tahun
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $months[] = Carbon::createFromDate($year, $month, 1)->format('F');
        }

        // Mengambil transaksi berdasarkan bulan dan tahun
        $monthlyTransactions = Transaction::selectRaw('MONTH(created_at) as month, COUNT(*) as total')->whereYear('created_at', $year)->groupBy('month')->orderBy('month')->get();

        // Menambahkan bulan-bulan yang tidak memiliki transaksi
        $monthlyReport = [];
        foreach ($months as $monthName) {
            $monthlyReport[$monthName] = 0; // Set default 0 untuk setiap bulan
        }

        foreach ($monthlyTransactions as $transaction) {
            $monthName = Carbon::createFromFormat('m', $transaction->month)->format('F');
            $monthlyReport[$monthName] = $transaction->total;
        }

        $labelsTransaksi = array_keys($monthlyReport);
        $valuesTransaksi = array_values($monthlyReport);


        ////////////////////////////////////////////////////////////////////////
        
        /////////////////////////////////////////////////////////////////////

        return view('backend.dashboard.index', [
            'active' => 'dashboard',
            'StatusTransaksi' => $statusTransaksi,
            'jumlahTransaksi' => $jumlahTransaksi,
            'jumlahUsers' => user::count() - User::where('role', 'admin')->count(),
            'totalOrder' => Transaction::distinct('order_number')->count(),
            'totalProduct' => Product::count(),
            'labelsTransaksi' => $labelsTransaksi,
            'valuesTransaksi' => $valuesTransaksi
        ]);
    }
}
