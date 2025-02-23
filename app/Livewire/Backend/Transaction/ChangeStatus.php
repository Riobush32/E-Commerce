<?php

namespace App\Livewire\Backend\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\On;

class ChangeStatus extends Component
{

    public $order_number, $status, $transactionData, $statusText;
    public $showStatus = false;


    #[On('toogleChangeStatus')]
    public function toogleChangeStatus($order_number){
        dd($order_number);
        $this->transactionData = Transaction::where('order_number',$order_number)->first();
        $this->status = $this->transactionData->status;
        $this->showStatus = true;
    }

    public function render()
    {
        return view('livewire.backend.transaction.change-status');
    }
}