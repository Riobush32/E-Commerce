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
        $this->transactionData = Transaction::where('order_number',$order_number)->first();
        $this->status = $this->transactionData->status;
        $this->order_number = $order_number;
        if($this->status == 1){
            $this->statusText = "Pesanan Diproses";
        }else if($this->status == 2){
            $this->statusText = "Pesanan DiPacking";
        }else if($this->status == 3){
            $this->statusText = "Pesanan Dikirim";
        }else if($this->status == 4){
            $this->statusText = "Pesanan Diterima";
        }else if($this->status == 5){
            $this->statusText = "Pesanan Selesai";
        }
        $this->showStatus = true;
    }

    public function changeStatus(){
        Transaction::where("order_number", $this->order_number)->update(['status' => $this->status]);
        $this->dispatch('updateTransactionList');
        $this->dispatch('updateNotifications');
        session()->flash('message', 'Status Di Update!');
        $this->showStatus = false;
    }

    public function render()
    {
        return view('livewire.backend.transaction.change-status');
    }
}