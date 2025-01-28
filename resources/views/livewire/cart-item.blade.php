<div class="grid grid-cols-5 gap-4 w-full p-2 ">

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
                                x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format({{ $cart->variant->product->price }})"></span>
                        </h1>
                    </div>
                    <div class="items-center flex">
                        <div class="join join-vertical lg:join-horizontal mt-2 border-[1px]">
                            <button class="btn btn-sm join-item text-lg font-bold"
                                wire:click="updateQuantity({{ $cart->id }},  'minus')">-</button>
                            <input class="input input-sm w-24 join-item text-center"
                                value="{{ $cart->quantity }}"  min="1" />
                            <button class="btn btn-sm join-item text-lg font-bold"
                                wire:click="updateQuantity({{ $cart->id }},  'plus')">+</button>
                        </div>
                    </div>
                    {{-- total price --}}
                    <div class="items-center flex gap-4">
                        <div class="">
                            <h1 class="text-primary">
                                <span
                                    x-text="new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }).format({{ $cart->variant->product->price }} * {{ $cart->quantity }})"
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
</div>
