<div x-data="{ detail_ongkir: false }">

    @if ($checkout)
        <div
            class="absolute flex justify-center items-center z-30 w-screen h-screen -top-32 -left-20 bg-slate-200 bg-opacity-50 ">
            <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
                data-client-key="{{ config('services.midtrans.client_key') }}"></script>
            <div class="">
                <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                    <div class="flex justify-between items-center">
                        <div class="">
                            <h2 class="text-2xl font-bold mb-4">Checkout</h2>
                        </div>
                        <div class="">
                            <button wire:click="$dispatch('uncheckout')"
                                class="w-full bg-transparent -top-3 rounded-lg font-bold  text-rose-700 transition">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex gap-8">
                        <!-- Daftar Produk -->
                        <div class="space-y-4">
                            @foreach ($data_items_checkout as $item)
                                <div class="flex gap-4 justify-between items-center border-b pb-2">
                                    <div>
                                        <h3 class="font-semibold">{{ $item->variant->product->name }}</h3>
                                        <p class="text-gray-500">Qty: ${{ $item->quantity }}</p>
                                    </div>
                                    <span
                                        class="font-bold">Rp{{ number_format($item->variant->product->price, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="">
                            <!-- Ringkasan Pembayaran -->
                            <div class="mt-6 border-t pt-4">
                                <div class="flex justify-between">
                                    <span>Subtotal</span>
                                    <span class="font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex gap-4 justify-between">
                                    <span>Biaya Pengiriman</span>
                                    <span class="font-bold">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex gap-4 justify-between">
                                    <span>Discout</span>
                                    <span class="font-bold">Rp {{ number_format($discount, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex gap-4 justify-between text-lg font-bold mt-2">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($payment, 0, ',', '.') }}</span>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- Informasi Pembeli -->
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">Informasi Pembeli</h3>
                        <p class="text-gray-600">{{ $shippingAddress->name }}</p>
                        <p class="text-gray-600">{{ Auth::user()->email }}</p>
                        <p class="text-gray-600">{{ $shippingAddress->no_hp }}</p>
                        <p class="text-gray-600 max-w-96 italic font-semibold">
                            <span>{{ $shippingAddress->address }}, </span>
                            <span>{{ $shippingAddress->kelurahan }}, </span>
                            <span>{{ $shippingAddress->kecamatan }}, </span>
                            <span>{{ $shippingAddress->city_name }}, </span>
                            <span>{{ $shippingAddress->kelurahan }}, </span>
                            <span>{{ $shippingAddress->province }}, </span>
                            <span>{{ $shippingAddress->postal_code }}, </span>
                        </p>
                    </div>

                    <!-- Tombol pay -->
                    <button wire:click="$dispatch('pay')"
                        class="mt-6 w-full bg-primary text-white py-2 rounded-lg font-bold hover:bg-orange-800 transition">
                        Pay
                    </button>
                </div>


            </div>
        </div>
    @endif


    <div class="">
        <div x-show="detail_ongkir" @click.outside="detail_ongkir=false"
            class="absolute top-0 left-1/2 p-4 bg-white shadow-md border border-primary rounded-md z-30 delay-1000">

            @if ($ongkir)

                <h3 class="text-lg font-bold">Opsi Pengiriman</h3>
                <ul>
                    @foreach ($ongkir as $courier)
                        <li>
                            {{ $courier['name'] }}
                            <ul>
                                @foreach ($courier['costs'] as $cost)
                                    <li>
                                        {{ $cost['service'] }} - {{ $cost['description'] }}
                                        <br>
                                        Biaya: Rp. {{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}
                                        <br>
                                        Estimasi Waktu: {{ $cost['cost'][0]['etd'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada opsi pengiriman</p>
            @endif
        </div>
    </div>
    <div class="w-1/5 relative z-10">
        <div class="fixed bottom-16 h-[70vh] p-3 w-1/5">
            <div class="text-right ">
                <h1 class="text-2xl">Summary</h1>
                <h1 class="text-secondary"><span class="text-primary">{{ $count_data }}</span> items slected</h1>
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
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </div>
                    <div class="text-secondary flex">
                        Shipping & Handing
                        @if ($check_ongkir)
                            <button @click="detail_ongkir=true" class="btn btn-xs btn-primary text-white font-light"><i
                                    class="fa-solid fa-info"></i></button>
                        @endif
                    </div>
                    <div class="text-right flex">
                        @if ($isShippingAddress)
                            @if ($check_ongkir)
                                Rp.
                                {{ number_format($shippingCost, 0, ',', '.') }}
                            @else
                                <button wire:click="$dispatch('check_ongkir')"
                                    class="btn btn-xs btn-primary text-white font-light">Check Ongkir</button>
                            @endif
                        @else
                            <a href="{{ route('addShippingAddress') }}"
                                class="btn btn-xs btn-primary text-white font-light">set your Address</a>
                        @endif
                    </div>
                    <div class="text-secondary">Discount</div>
                    <div class="text-right">Rp 200.000</div>
                </div>
                <div class="mt-2">
                    <div class="grid grid-cols-2 gap-1 justify-between">
                        <div class="text-lg">Cart Total</div>
                        <div class="text-right">
                            @if ($check_ongkir)
                                Rp {{ number_format($payment, 0, ',', '.') }}
                            @endif

                        </div>
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
                @if ($check_ongkir)
                    <button wire:click="$dispatch('checkout')"
                        class="btn rounded-full text-white btn-primary tracking-wide font-light z-20">
                        Pay Rp {{ number_format($payment, 0, ',', '.') }}
                    </button>
                @endif
                @if (!$check_ongkir)
                    <button wire:click="$dispatch('check_ongkir')"
                        class="btn rounded-full text-white btn-primary tracking-wide font-light">
                        Check Ongkir Dulu
                    </button>
                @endif

            </div>
        </div>


    </div>

</div>
