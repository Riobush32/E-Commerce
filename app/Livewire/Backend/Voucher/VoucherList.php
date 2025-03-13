<?php

namespace App\Livewire\Backend\Voucher;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class VoucherList extends Component
{
    use WithPagination;
    public $perPage = 5,  $search = '', $voucherEdit = 'false', $voucherData = [];
    protected $queryString = ['perPage'];
    public $voucher = array();

    #[On('updateVoucherList')]
    public function updateVoucherList()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman pertama saat pencarian berubah
    }
    public function updatingPerPage()
    {
        $this->resetPage(); // Reset ke halaman pertama saat jumlah data berubah
    }

    public function mount()
    {
        $this->voucher = Voucher::latest()->get();
    }

    public function deleteVoucher($id){
        Voucher::find($id)->delete();
    }
    public function render()
    {
        return view('livewire.backend.voucher.voucher-list', [
            'vouchers' => Voucher::where('name', 'like', '%' . $this->search . '%')->latest()
                ->paginate($this->perPage)
        ]);
    }
}
