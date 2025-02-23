<?php

namespace App\Livewire\Backend\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionList extends Component
{
    use WithPagination;
    public $search = '',
        $perPage;

    public function mount()
    {
        // $this->transactions = Transaction::all();
        $this->perPage = 10;
    }
    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman pertama saat pencarian berubah
    }
    public function updatingPerPage()
    {
        $this->resetPage(); // Reset ke halaman pertama saat jumlah data berubah
    }
    public function render()
    {
        // Ambil data transaksi dan kelompokkan berdasarkan order_number
        $data = Transaction::with(['user', 'cart', 'summary'])->latest()->get()->groupBy('order_number');

        // Mengonversi Collection ke array
        $data = $data->toArray();

        // Mendapatkan halaman saat ini
        $page = request()->get('page', 1);

        // Menghitung offset
        $offset = ($page - 1) * $this->perPage;

        // Mengambil data untuk halaman tertentu
        $currentPageData = array_slice($data, $offset, $this->perPage);

        // Membuat instance LengthAwarePaginator
        $transactions = new LengthAwarePaginator(
            $currentPageData, // Data untuk halaman saat ini
            count($data), // Total jumlah data
            $this->perPage, // Jumlah item per halaman
            $page, // Halaman saat ini
            ['path' => request()->url(), 'query' => request()->query()], // Menyertakan query string dan URL
        );

        // dd($transactions);
        // Mengirim data ke view
        return view('livewire.backend.transaction.transaction-list', [
            'orders' => $transactions,
        ]);
    }
}