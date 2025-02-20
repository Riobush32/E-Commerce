<?php

namespace App\Livewire;

use App\Models\Chat;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatBubble extends Component
{
    public $toUser;
    public $messageText = "";
    public function mount($to_user){
        $this->toUser = $to_user;
        $this->dispatch('messageAdded', Auth::user()->id);
    }
    public function sendMessage(){
        // dd($this->messageText);
        Chat::create([
            'user_id' => Auth::user()->id,
            'to_user_id' => $this->toUser,
           'message' => $this->messageText,
        ]);
        $this->reset('messageText');
        $this->dispatch('messageAdded', Auth::user()->id);
    }
    public function render()
    {
        return view('livewire.chat-bubble', [
            'messages' => Chat::where('user_id', Auth::user()->id)
                            ->orWhere('user_id', $this->toUser)
                            ->orWhere('to_user_id', Auth::user()->id)
                            ->orWhere('to_user_id', $this->toUser)
                            ->get(),
        ]);
    }
}