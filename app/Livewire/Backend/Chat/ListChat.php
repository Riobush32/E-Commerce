<?php

namespace App\Livewire\Backend\Chat;

use App\Models\Chat;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ListChat extends Component
{
    public $chats, $toUser, $messages;
    public $messageText;
    public $chooseSender = false;

    public function sendMessage(){
        Chat::create([
            'user_id' => Auth::user()->id,
            'to_user_id' => $this->toUser,
            'message' => $this->messageText,
        ]);
        $this->reset('messageText');
        $this->messages = Chat::where('user_id', Auth::user()->id)
        ->orWhere('user_id', $this->toUser)
        ->orWhere('to_user_id', Auth::user()->id)
        ->orWhere('to_user_id', $this->toUser)
        ->get();
    }
    public function chatToUser($user_id){

        $this->toUser = $user_id;
        $this->chooseSender = true;
        $this->messages = Chat::where('user_id', Auth::user()->id)
        ->orWhere('user_id', $this->toUser)
        ->orWhere('to_user_id', Auth::user()->id)
        ->orWhere('to_user_id', $this->toUser)
        ->get();
    }
    public function mount(){
        $this->chats = Chat::all();
        $this->toUser = 0;
    }

    public function render()
    {
        return view('livewire.backend.chat.list-chat');
    }
}