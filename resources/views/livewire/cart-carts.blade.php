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
                    x-model="selectedItems" class="hidden">
                <label for="product-{{ $cart->id }}" class="block p-2 rounded-xl mt-5"
                    :class="selectedItems.includes('{{ $cart->id }}') ? 'border border-primary shadow-xl' : ''">
                    <livewire:cart-item wire:key="cart-{{ $cart->id }}" :cart="$cart" :index="$index"/>

                </label>
            @endforeach



        </div>
        @if ($carts->isNotEmpty() && $carts->first()->id != null)
            <div class="w-1/5 relative z-10">
                <div class="fixed bottom-16 h-[70vh] p-3 w-1/5">
                    <div class="text-right ">
                        <h1 class="text-2xl">Summary</h1>
                        <h1 class="text-secondary"><span x-text="selectedItems"></span> items slected</h1>
                        <hr class="mt-3 border-black">
                    </div>
                    {{-- voucher --}}
                    <div class="mt-3">
                        <h1>Vocher</h1>
                        <div class="w-full">
                            <div
                                class="bg-primary w-full text-white p-3 rounded-xl shadow-lg shadow-slate-400 hover:scale-105 hover:shadow-black ease-in-out duration-300 cursor-pointer">
                                <div class="">
                                    <h1 class="text-md fontbold">20% Off</h1>
                                    <p class="text-xs text-slate-200">if order <span class="text-white">Rp
                                            200.000</span>
                                    </p>
                                </div>
                                <div class="text-sm text-right">
                                    <h2>Until Dec, 30 2024</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- detail total  --}}
                    <div class="mt-5">
                        <div class="grid grid-cols-2 gap-1 justify-between">
                            <div class="text-secondary ">Subtotal</div>
                            <div class="text-right">
                                Rp {{ number_format($this->subtotal, 0, ',', '.') }}
                            </div>
                            <div class="text-secondary">Shipping & Handing</div>
                            <div class="text-right">Rp {{ $shippment_cost }}</div>
                            <div class="text-secondary">Discount</div>
                            <div class="text-right">Rp 200.000</div>
                        </div>
                        <div class="mt-2">
                            <div class="grid grid-cols-2 gap-1 justify-between">
                                <div class="text-lg">Cart Total</div>
                                <div class="text-right">Rp 130.000</div>
                            </div>
                        </div>

                    </div>
                    <hr class="my-3">

                    {{-- <a class="cursor-pointer block" href="{{ route('shipping', ['cart_id' => $carts->first()->id]) }}">
                        <h1>Shippment Address</h1>
                        <p class="text-secondary text-xs">
                            <span class="text-slate-800">{{ $shippingAddress->name }}</span> |
                            <span>{{ $shippingAddress->no_hp }}</span>
                            <br>
                            {{ $shippingAddress->province }}, {{ $shippingAddress->city_name }},
                            {{ $shippingAddress->kecamatan }}, {{ $shippingAddress->kelurahan }}.
                            <br>
                            {{ $shippingAddress->address }}, <span
                                class="text-slate-800">{{ $shippingAddress->postal_code }}</span>.
                        </p>
                    </a> --}}


                    <div class="mt-5 flex items-center justify-center">
                        <button class="btn rounded-full text-white btn-primary tracking-wide font-light">
                            Pay Rp 130.000
                        </button>
                    </div>
                </div>


            </div>
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
        {{--
        <div class="w-full fixed flex justify-center" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="" @click.outside="modal = false">
                <div class="modal-box bg-slate-600 min-w-96 text-white">
                    <h3 class="text-lg font-bold">Pilih Pengiriman</h3>
                    <div class="modal-action justify-start">
                        <form method="post" :action="getDeleteUrl()">
                            @csrf
                            @forelse ($ongkir as $item)
                                @foreach ($item['costs'] as $indexCost => $costs)
                                    @foreach ($costs['cost'] as $index => $cost)
                                        <div class="my-2">
                                            <input type="radio"
                                                wire:click="updateShippment('{{ $cost['value'] }}', '{{ $item['name'] }}', '{{ $costs['service'] }}', '{{ $cost['etd'] }}')"
                                                id="shipping-{{ $loop->parent->index }}-{{ $index }}"
                                                name="shipping"
                                                value="{{ $item['name'] }}|{{ $costs['service'] }}|{{ $cost['value'] }}|{{ $cost['etd'] }}"
                                                class="hidden peer" required />
                                            <label for="shipping-{{ $loop->parent->index }}-{{ $index }}"
                                                class="inline-flex items-center justify-between w-full p-5 border rounded-lg cursor-pointer hover:text-gray-300 border-gray-700 peer-checked:text-primary peer-checked:border-orange-500 text-gray-400 bg-gray-800 hover:bg-gray-700">
                                                <div class="block">
                                                    <div class="flex gap-1 w-full text-lg font-semibold">
                                                        <div>
                                                            Rp {{ number_format($cost['value'], 0, ',', '.') }}
                                                        </div>
                                                        <div class="badge badge-outline badge-primary">
                                                            {{ $costs['service'] }}
                                                        </div>
                                                    </div>
                                                    <div class="w-full">{{ $cost['etd'] }} Hari</div>
                                                </div>
                                                <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </label>
                                        </div>
                                    @endforeach
                                @endforeach
                            @empty
                                <div class="text-center text-gray-500">
                                    <p>Data ongkir tidak tersedia.</p>
                                </div>
                            @endforelse


                            <div class="w-full">
                                <button class="btn mt-3" type="submit">Yes</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
    <script>

    </script>
</div>
