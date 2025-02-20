<?php

namespace App\Livewire\Backend\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TransactionList extends Component
{
    use WithPagination;
    public $search ="", $perPage;

    public function mount()
    {
        // $this->transactions = Transaction::all();
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
        return view('livewire.backend.transaction.transaction-list', [
            'transactions' => Transaction::all(),
        ]);
    }
}
