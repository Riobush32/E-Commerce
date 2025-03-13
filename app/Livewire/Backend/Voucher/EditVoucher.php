<?php

namespace App\Livewire\Backend\Voucher;

use App\Models\Voucher;
use Livewire\Component;
use Livewire\Attributes\On;

class EditVoucher extends Component
{
    public $showEditVoucher = false, $id = null;
    public  $voucherName,
        $voucherPoins,
        $voucher_valid_from,
        $voucher_valid_until,
        $voucher_min_purchase,
        $voucher_discount_type = '',
        $voucher_discount_value;

    #[On('toogleVoucherEdit')]
    public function toogleVoucherEdit($id)
    {
        $voucherData = Voucher::find($id);
        $this->id = $voucherData->id;
        $this->showEditVoucher = true;
        $this->voucherName            = $voucherData->name;
        $this->voucherPoins            = $voucherData->points_required;
        $this->voucher_valid_from      = $voucherData->valid_from;
        $this->voucher_valid_until     = $voucherData->valid_until;
        $this->voucher_min_purchase    = $voucherData->min_purchase;
        $this->voucher_discount_type   = $voucherData->discount_type;
        $this->voucher_discount_value  = $voucherData->discount_value;
    }

    public function editVoucher()
    {
        $voucher = Voucher::find($this->id);
        if ($this->voucher_discount_type == 'fixed') {
            $value = (int) str_replace(['Rp', '.', ','], '', $this->voucher_discount_value);
        } elseif ($this->voucher_discount_type == 'percentage') {
            $value = (int) str_replace('%', '', $this->voucher_discount_value);
        }
        $this->validate([
            'voucherName'              => 'required|string|min:3',
            'voucherPoins'    => 'required',
            'voucher_min_purchase'        => 'required',
            'voucher_valid_until'       => 'required',
            'voucher_valid_from'      => 'required',
            'voucher_discount_type'     => 'required',
            'voucher_discount_value'    => 'required'
        ]);

        $voucher->update([
            'name'              => $this->voucherName,
            'points_required'    => $this->voucherPoins,
            'valid_from'        => $this->voucher_valid_from,
            'valid_until'       => $this->voucher_valid_until,
            'min_purchase'      => (int) str_replace(['Rp', '.', ','], '', $this->voucher_min_purchase),
            'discount_type'     => $this->voucher_discount_type,
            'discount_value'    => $value,
        ]);
        $this->dispatch('updateVoucherList');
        $this->showEditVoucher = false;
    }
    public function render()
    {
        return view('livewire.backend.voucher.edit-voucher');
    }
}
