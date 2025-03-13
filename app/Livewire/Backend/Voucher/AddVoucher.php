<?php

namespace App\Livewire\Backend\Voucher;

use App\Models\Voucher;
use Livewire\Component;

class AddVoucher extends Component
{
    public  $voucherName, 
            $voucherPoins, 
            $voucher_valid_from, 
            $voucher_valid_until, 
            $voucher_min_purchase, 
            $voucher_discount_type = '', 
            $voucher_discount_value;

    public function saveNewVoucher(){
        if($this->voucher_discount_type == 'fixed'){
            $value = (int) str_replace(['Rp', '.', ','], '', $this->voucher_discount_value);
        } elseif($this->voucher_discount_type == 'percentage'){
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

        Voucher::create([
            'name'              => $this->voucherName,
            'points_required'    => $this->voucherPoins,
            'valid_from'        => $this->voucher_valid_from,
            'valid_until'       => $this->voucher_valid_until,
            'min_purchase'      => (int) str_replace(['Rp', '.', ','], '', $this->voucher_min_purchase),
            'discount_type'     => $this->voucher_discount_type,
            'discount_value'    => $value,
        ]);

        $this->reset(
            'voucherName',
                        'voucherPoins', 
                        'voucher_valid_from', 
                        'voucher_valid_until', 
                        'voucher_min_purchase', 
                        'voucher_discount_type', 
                        'voucher_discount_value');
        $this->dispatch('updateVoucherList');
    }

    public function render()
    {
        return view('livewire.backend.voucher.add-voucher');
    }
}
