<div>
    <x-flash-message></x-flash-message>

    <div class="my-5">
        <h1 class="text-2xl">Shopping bag</h1>
        <h2>{{ $carts->count() }} items <span class="text-gray-500">in your bag.</span></h2>
    </div>
    {{-- cart  --}}
    <div class="flex gap-3 relative" x-data="{
        selectedItems: [],
        modal: false,
        modalData: null,
        getDeleteUrl() {
            return `{{ route('cartDestroy', '') }}/${this.modalData}`;
        }
    }">
        <div class="w-4/5">

            <div class="grid grid-cols-5 gap-4 w-full " x-data="{ count: 0, price: 0 }">
                {{-- table head --}}
                <div style="grid-column: span 2">Products</div>
                <div class="">Price</div>
                <div class="">Quantity</div>
                <div class="">Total Price</div>
            </div>
            @foreach ($carts as $index => $cart)
                <input type="checkbox" id="product-{{ $cart->id }}" value="{{ $cart->id }}"
                    x-model="selectedItems" class="hidden" wire:model="selectedItems" wire:change="updateSelection">
                <label for="product-{{ $cart->id }}" class="block p-2 rounded-xl mt-5"
                    :class="selectedItems.includes('{{ $cart->id }}') ? 'border border-primary shadow-xl' : ''">
                    <livewire:cart-item wire:key="cart-{{ $cart->id }}" :cart="$cart" :index="$index"/>

                </label>
            @endforeach

        </div>
        @if ($carts->isNotEmpty() && $carts->first()->id != null)
            <livewire:cart-summary :carts="$carts" :selectedItems="[]"></livewire:cart-summary>
        @endif

        <div class="w-full fixed flex justify-center" x-show="modal"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="" @click.outside="modal = false">
                <div class="modal-box bg-primary min-w-96">
                    <h3 class="text-lg font-bold">Warning!</h3>
                    <p class="py-4">Are you sure you want to delete this <span x-text="modalData"></span> item from
                        your cart? </p>
                    <div class="modal-action">
                        <form method="post" :action="getDeleteUrl()">
                            @csrf
                            @method('delete')
                            <!-- if there is a button in form, it will close the modal -->
                            <button class="btn" @click="modal = false">Close</button>
                            <button class="btn" type="submit">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
