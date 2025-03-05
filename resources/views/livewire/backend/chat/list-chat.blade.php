<div>
    <div class="flex py-3">
        <div class="w-1/3 h-[70vh] rounded-s-lg bg-white p-3">
            @php
                $sender = 0;
            @endphp
            @foreach ($chats as $chat)
                @if ($sender = (0 && $chat->sender->role != 'admin') || ($sender != $chat->user_id && $chat->sender->role != 'admin'))
                    <a role="alert" class="alert cursor-pointer" wire:click="chatToUser({{ $chat->user_id }})">
                        <div class="avatar">
                            <div class="ring-primary ring-offset-base-100 w-7 rounded-full ring ring-offset-2">
                                <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                            </div>
                        </div>
                        <span>{{ $chat->sender->name }} </span>
                    </a>
                @endif
                @php
                    $sender = $chat->user_id;
                @endphp
            @endforeach

        </div>
        <div class="relative w-2/3 h-[70vh] rounded-e-lg p-3 bg-repeat bg-center bg-[length:180px_120px] bg-white/30 backdrop-brightness-110"
            style="background-image: url('{{ asset('img/chat-bg2.jpg') }}');">
            @if ($chooseSender)
                <div class="w-full p-3 absolute top-0 left-0   bg-green-400 flex items-center gap-6">
                    <div class="avatar">
                        <div class="ring-primary ring-offset-base-100 w-7 rounded-full ring ring-offset-2">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                        </div>
                    </div>
                    <span>Nama </span>
                </div>
                <div wire:poll class=" ">

                    <div
                        class=" mt-10 mb-28 max-h-[50vh] overflow-auto scrollbar-thin scrollbar-thumb-blue-500 hover:scrollbar-thumb-blue-700 scrollbar-track-gray-300">
                        @foreach ($messages as $message)
                            <div class="chat {{ $message->user_id != Auth::user()->id ? 'chat-start' : 'chat-end' }} ">
                                <div class="chat-image avatar">
                                    <div class="w-10 rounded-full">
                                        <img alt="Tailwind CSS chat bubble component"
                                            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                                    </div>
                                </div>

                                <div class="chat-header">
                                    {{ $message->sender->name }}
                                    <time
                                        class="text-xs opacity-95 text-fuchsia-700">{{ $message->created_at->diffForHumans() }}</time>
                                </div>
                                <div
                                    class="chat-bubble {{ $message->user_id == Auth::user()->id ? 'chat-bubble-primary' : 'chat-bubble-success' }}">
                                    @if ($message->product_id != '' || $message->product_id != null)
                                        <a href="{{ route('productDetails', $message->product_id) }}">
                                            <div class="avatar">
                                                <div class="w-16 rounded">
                                                    <img src="{{ asset($message->product->product_photos->first()->photo_patch) }}"
                                                        alt="Tailwind-CSS-Avatar-component" />
                                                </div>
                                            </div>
                                            <div class="text-yellow-300">
                                                {{ $message->product->name }}
                                            </div>
                                        </a>
                                    @endif
                                    <div class="text-white">
                                        {{ $message->message }}
                                    </div>
                                </div>
                                <div class="chat-footer opacity-95 text-rose-500">Seen at
                                    {{ $message->created_at->format('H:i') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="fixed bottom-5 w-full z-30 mt-3 flex justify-center ">
                        <form wire:submit="sendMessage" class="flex justify-center gap-2 w-5/6 mx-auto">
                            <textarea id="sendText" wire:model="messageText" class="textarea textarea-primary w-full rounded-3xl"
                                placeholder="Bio"></textarea>
                            <button type="submit" class="btn btn-circle btn-primary">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex w-full h-full justify-center items-center">
                    <div class="bg-white rounded-xl p-3">
                        pilih pesan anda
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
