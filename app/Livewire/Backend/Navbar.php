<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\On;

class Navbar extends Component
{
    public $notifications = [];

    #[On('updateNotifications')]
    public function updateNotifications(){
        $this->notifications = Transaction::where('status', '1')->get();
    }

    public function mount(){
        $this->notifications = Transaction::where('status', '1')->get();
    }
    public function render()
    {
        return view('livewire.backend.navbar');
    }
}