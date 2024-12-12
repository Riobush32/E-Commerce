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
            @foreach ($carts as $cart)
                <input type="checkbox" id="product-{{ $cart->id }}" value="{{ $cart->id }}"
                    x-model="selectedItems" class="hidden" wire:model.live="selectedItems">
                <label for="product-{{ $cart->id }}" class="p-2 rounded-xl  grid grid-cols-5 gap-4 w-full mt-5"
                    :class="selectedItems.includes('{{ $cart->id }}') ? 'border border-primary shadow-xl' : ''"
                    x-data="{
                        count: {{ $cart->quantity }},
                        price: {{ $cart->variant->product->price }},
                        quantity: {{ $cart->quantity }},

                        updateQuantity() {
                            $wire.updateQuantity({{ $cart->id }}, this.quantity)
                        }
                    }">
                    <div class="flex gap-3 " style="grid-column: span 2">
                        <a href="{{ route('productDetails', ['id' => $cart->variant->product->id]) }}"
                            class="w-1/3 overflow-hidden rounded-xl">
                            <img src="{{ $cart->variant->product->product_photos->first()->photo_patch }}"
                                alt="">
                        </a>
                        <div class="grid grid-cols-1 content-around h-full">
                            <div class="">
                                <h1 class="text-secondary">{{ $cart->variant->product->brand->name }}</h1>
                                <h3 class="text-xl">{{ $cart->variant->product->name }}</h3>
                            </div>
                            <div class="">
                                <span class="text-secondary">varian:</span> {{ $cart->variant->name }}
                            </div>
                        </div>
                    </div>
                    {{-- price  --}}
                    <div class="items-center flex">
                        <h1 class=""> <span
                                x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price)"></span>
                        </h1>
                    </div>
                    <div class="items-center flex">
                        <div class="join join-vertical lg:join-horizontal mt-2 border-[1px]" x-data="{

                        }">
                            <button class="btn btn-sm join-item text-lg font-bold"
                                @click="quantity > 1 ? quantity-- : quantity = 1; updateQuantity()">-</button>
                            <input class="input input-sm w-24 join-item text-center" x-model.number="quantity"
                                @change="updateQuantity()" min="1" />
                            <button class="btn btn-sm join-item text-lg font-bold"
                                @click="quantity++; updateQuantity()">+</button>
                        </div>
                    </div>
                    <div class="items-center flex gap-4">
                        <div class="">
                            <h1 class="text-primary">
                                <span
                                    x-text="new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }).format(price * quantity)"
                                    class="text-primary"></span>

                            </h1>
                        </div>
                        <div class="">
                            <button @click="modal = true, modalData = {{ $cart->id }}"
                                class="btn btn-outline btn-error">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>

                    </div>
                </label>
            @endforeach



        </div>

        <div class="w-1/5 relative -z-10">
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
                                <p class="text-xs text-slate-200">if order <span class="text-white">Rp 200.000</span>
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
                        <div class="text-right">Rp 20.000</div>
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
                <a class="cursor-pointer">
                    <h1>Shippment Address</h1>
                    <p class="text-secondary text-xs">Jl. Melati No. 123, Kelurahan Sejahtera, Kecamatan Harmoni, Kota
                        Bahagia, Provinsi Gemilang, 54321</p>
                </a>
                <div class="mt-5 flex items-center justify-center">
                    <button class="btn rounded-full text-white btn-primary tracking-wide font-light">
                        Pay Rp 130.000
                    </button>
                </div>
            </div>


        </div>

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
