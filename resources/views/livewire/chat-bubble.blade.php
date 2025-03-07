<div class="relative w-[600px] mx-auto mt-3 shadow-xl shadow-slate-700 rounded-3xl border bg-repeat bg-center bg-[length:180px_120px] bg-opacity-35 overflow-hidden"
    style="background-image: url('{{ asset('img/chat-bg2.jpg') }}');">

    <div wire:poll class="bg-white/30 backdrop-brightness-110 p-5">
        <div class="px-3 mb-28 max-h-[65vh] overflow-auto scrollbar-thin scrollbar-thumb-blue-500 hover:scrollbar-thumb-blue-700 scrollbar-track-gray-300"
            id="chat-container">
            @foreach ($messages as $message)
                <div class="chat {{ $message->user_id != Auth::user()->id ? 'chat-start' : 'chat-end' }} ">
                    <div class="chat-image avatar">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS chat bubble component"
                                src="https://tse4.mm.bing.net/th?id=OIP.ZE2YEvUMEQOyT13WVMHKtwAAAA&pid=Api&P=0&h=180" />
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
                    <div class="chat-footer opacity-95 text-rose-500">Seen at {{ $message->created_at->format('H:i') }}
                    </div>
                </div>
            @endforeach
        </div>
        {{-- chat --}}

        {{-- messages --}}

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

    <script>
        document.addEventListener('livewire:init', () => {
            // Function to scroll the chat container to the bottom
            // const messages = @json($messages);

            // Listen for changes in the content to trigger the scroll action
            Livewire.on('messageAdded', (userId) => {
                console.log('messageAdded event triggered'); // Debugging log
                setTimeout(function() {
                    scrollToBottom();
                    sendReset();
                }, 500); // Delay a bit before scrolling and resetting the input field
            });
            // setInterval(() => {
            //     if ($messages.lenght){

            //     }
            // }, 100);

            // Initialize scroll to bottom when the page loads
            window.onload = scrollToBottom;
            // setInterval(scrollToBottom, 100);
        });

        function sendReset() {
            const send = document.getElementById('sendText');
            send.value = ''; // Reset the textarea after sending message
        }

        function scrollToBottom() {
            const chatContainer = document.getElementById('chat-container');
            console.log('scrolling to bottom'); // Debugging log
            chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll to bottom of chat container
        }
    </script>
</div>
