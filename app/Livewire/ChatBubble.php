<?php

namespace App\Livewire;

use App\Models\Chat;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatBubble extends Component
{
    public $toUser;
    public $productId;
    public $messageText = '';
    public function mount($to_user, $product_id = null)
    {
        $this->toUser = $to_user;
        $this->productId = $product_id;
        $this->dispatch('messageAdded', Auth::user()->id);
    }
    public function sendMessage()
    {
        // dd($this->messageText);
        if ($this->productId == null || $this->productId == '') {
            Chat::create([
                'user_id' => Auth::user()->id,
                'to_user_id' => $this->toUser,
                'message' => $this->messageText,
            ]);
        } elseif ($this->productId != null) {
            Chat::create([
                'user_id' => Auth::user()->id,
                'to_user_id' => $this->toUser,
                'message' => $this->messageText,
                'product_id' => $this->productId,
            ]);
            $this->reset('productId');
        }

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