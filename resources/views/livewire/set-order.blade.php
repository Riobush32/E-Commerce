<div class="w-1/5">
    @if ($showMyVoucher)
        <div
            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-slate-200 max-w-[75vw] max-h-[55vh] p-6 rounded-lg">
            <div class=" grid grid-cols-3 gap-4">
                @foreach ($voucherData as $voucher)
                    <div wire:click="chooseVoucher({{ $voucher->voucher->id }})"
                        class="{{ $voucher->voucher->valid_from <= now()->toDateString() &&
                        now()->toDateString() <= $voucher->voucher->valid_until
                            ? ($voucher->voucher->min_purchase <= $productData->price * $quantity
                                ? 'bg-primary'
                                : 'bg-red-600')
                            : 'bg-red-600' }} cursor-pointer bg-primary w-full text-white p-3 rounded-xl shadow-lg shadow-slate-400 hover:scale-105 hover:shadow-black ease-in-out duration-300">
                        <div class="">
                            <h1
                                class="text-md font-bold {{ $voucher->voucher->valid_from <= now()->toDateString() &&
                                now()->toDateString() <= $voucher->voucher->valid_until
                                    ? ($voucher->voucher->min_purchase <= $productData->price * $quantity
                                        ? ''
                                        : 'line-through')
                                    : 'line-through' }}">
                                @if ($voucher->voucher->discount_type == 'percentage')
                                    {{ number_format($voucher->voucher->discount_value, 0) }} %
                                @elseif($voucher->voucher->discount_type == 'fixed')
                                    Rp {{ number_format($voucher->voucher->discount_value) }}
                                @endif
                                Off
                            </h1>
                            <p class="text-xs text-slate-200">if order <span class="text-white">Rp
                                    {{ number_format($voucher->voucher->min_purchase) }}</span></p>
                        </div>
                        <div class="text-sm text-right">
                            <h2>Until {{ $voucher->voucher->valid_until }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    <div class=" p-5">


        {{-- set order  --}}
        <div id="formCart" method="POST" class="p-3 mt-3 w-full border-[1px] border-primary rounded-xl shadow-lg">

            Set Order:

            <hr class="border-primary ">
            @if ($variantData != [])
                <div class="p-2 flex gap-4 items-center">
                    <div class="w-1/4 rounded overflow-hidden">
                        <img src="{{ asset($variantData->variant_image) }}" alt="">
                    </div>
                    <div class="">
                        <p class="text-sm">selected variant</p>
                        <p>{{ $variantData->name }}</p>
                    </div>
                </div>
            @endif
            {{-- variants  --}}
            <div class="my-2">
                <h3 class="mb-2 text-sm font-medium ">Variant</h3>
                <ul class="flex flex-wrap w-full gap-2">
                    @forelse ($productData->variants as $variant)
                        @if ($variant->stock > 0)
                            <li>
                                <input type="radio" id="{{ $variant->name }}" wire:model.live="variantId"
                                    name="variant" value="{{ $variant->id }}" class="hidden peer" required />
                                <label for="{{ $variant->name }}" wire:click="setVariantData({{ $variant->id }})"
                                    class="inline-flex items-center justify-between w-full p-2 text-gray-500  border border-gray-200 rounded-lg cursor-pointer peer-checked:border-primary peer-checked:text-primary hover:text-gray-600 hover:bg-gray-100 ">
                                    <div class="block">
                                        <div class="w-full text-sm font-semibold">{{ $variant->name }}</div>
                                    </div>
                                </label>
                            </li>
                        @endif
                    @empty
                    @endforelse


                </ul>

            </div>


            {{-- count --}}
            <div class="">
                jumlah
            </div>
            <div wire:poll x-data="{ count: 1 }" class="join ">
                <button class="btn join-item text-lg font-bold" wire:click="decrementQuantity()">-</button>
                <button class="btn btn-ghost join-item">
                    {{ $quantity }}
                </button>
                <button wire:click="incrementQuantity()" class="btn join-item text-lg font-bold">+</button>
            </div>



            {{-- catatan  --}}
            <div class="my-2" x-data="{ catatan: false }">
                <div x-show="!catatan" @click="catatan = true"
                    class="font-medium text-primary dark:text-primary flex items-center cursor-pointer mb-2">
                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                    Tambah catatan
                </div>
                <div @click="catatan = false" x-show="catatan"
                    class="font-medium text-rose-600 dark:text-rose-500 flex items-center cursor-pointer mb-2">
                    Batalkan Catatan
                </div>
                <textarea wire:model.live="notes" name="notes" x-show="catatan" id="message" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-primary focus:ring-primary focus:border-primary "
                    placeholder="Tulis Catatanmu disini..."></textarea>
            </div>
            @if ($voucherSelected == '')
                <div class="my-2">
                    <button wire:click="voucher()" class="btn btn-sm btn-info">Gunakan Voucher</button>
                </div>
            @else
                <div wire:click="voucher()"
                    class="cursor-pointer {{ $voucherSelectedData->valid_from <= now()->toDateString() &&
                    now()->toDateString() <= $voucherSelectedData->valid_until
                        ? ($voucherSelectedData->min_purchase <= $productData->price * $quantity
                            ? 'bg-primary'
                            : 'bg-red-600')
                        : 'bg-red-600' }}  w-full text-white p-3 rounded-xl shadow-lg shadow-slate-400 hover:scale-105 hover:shadow-black ease-in-out duration-300">
                    <div class="">
                        <h1
                            class="text-md font-bold {{ $voucherSelectedData->valid_from <= now()->toDateString() &&
                            now()->toDateString() <= $voucherSelectedData->valid_until
                                ? ($voucherSelectedData->min_purchase <= $productData->price * $quantity
                                    ? ''
                                    : 'line-through')
                                : 'line-through' }}">
                            @if ($voucherSelectedData->discount_type == 'percentage')
                                {{ number_format($voucherSelectedData->discount_value, 0) }} %
                            @elseif($voucherSelectedData->discount_type == 'fixed')
                                Rp {{ number_format($voucherSelectedData->discount_value) }}
                            @endif
                            Off
                        </h1>
                        <p class="text-xs text-slate-200">if order <span class="text-white">Rp
                                {{ number_format($voucherSelectedData->min_purchase) }}</span></p>
                    </div>
                    <div class="text-sm text-right">
                        <h2>Until {{ $voucherSelectedData->valid_until }}</h2>
                    </div>
                </div>
            @endif

            {{-- subtotal --}}
            <div class="items-center justify-between my-3">
                @if ($voucherSelected != '')
                    @if (
                        $voucherSelectedData->valid_from <= now()->toDateString() &&
                            now()->toDateString() <= $voucherSelectedData->valid_until)
                        <div class="">discount</div>
                        <div class="text-xs md:text-lg font-bold text-gray-900  w-full mb-2">
                            Rp
                            @if (
                                $voucherSelectedData->discount_type == 'percentage' &&
                                    $voucherSelectedData->min_purchase <= $productData->price * $quantity)
                                {{ number_format($productData->price * $quantity * ($voucherSelectedData->discount_value / 100)) }}
                            @elseif(
                                $voucherSelectedData->discount_type == 'fixed' &&
                                    $voucherSelectedData->min_purchase <= $productData->price * $quantity)
                                {{ number_format($voucherSelectedData->discount_value) }}
                            @else
                                0
                            @endif

                        </div>
                        
                    @endif
                @endif
                <div class="">subtotal</div>
                @if ($voucherSelected != '')
                    @if (
                        $voucherSelectedData->valid_from <= now()->toDateString() &&
                            now()->toDateString() <= $voucherSelectedData->valid_until)
                        <div class="text-xs md:text-lg font-bold text-gray-900  w-full mb-2 ">
                            Rp
                            <span
                                class="{{ $voucherSelectedData->min_purchase <= $productData->price * $quantity ? 'line-through' : '' }}">
                                {{ number_format($productData->price * $quantity) }}
                            </span>
                        </div>
                        @if ($voucherSelectedData->min_purchase <= $productData->price * $quantity)
                            <div class="text-xs md:text-lg font-bold text-gray-900  w-full mb-2 ">
                                Rp
                                <span>
                                    @if ($voucherSelectedData->discount_type == 'percentage')
                                        {{ number_format($productData->price * $quantity - $productData->price * $quantity * ($voucherSelectedData->discount_value / 100)) }}
                                    @elseif($voucherSelectedData->discount_type == 'fixed')
                                        {{ number_format($productData->price * $quantity - $voucherSelectedData->discount_value) }}
                                    @endif
                                </span>
                            </div>
                        @endif
                    @else
                        <div class="text-xs md:text-lg font-bold text-gray-900  w-full mb-2 ">
                            Rp
                            {{ number_format($productData->price * $quantity) }}</div>
                    @endif
                @endif
                @if ($variantData != [])
                    <button type="button" wire:click="addToCart({{ $variantData->id }})"
                        class="w-full text-white bg-gradient-to-r from-orange-500 via-orange-400 to-orange-300 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                        Add to cart
                    </button>
                    <button type="button" wire:click="buyNow({{ $variantData->id }})"
                        class="w-full text-primary hover:text-white border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg md:text-sm text-xs md:px-5 px-3 md:py-2.5 py-1 text-center md:me-2 me-1 md:mb-2 mb-1 ">
                        Buy
                    </button>
                @endif

            </div>

            {{-- whislish  --}}
            <div class="flex justify-center">
                <div class="join join-vertical lg:join-horizontal w-full">
                    <button class="btn join-item w-1/3 text-red-500">
                        <i class="fa-solid fa-heart"></i>
                    </button>
                    <a href="{{ route('chat', $productData->id) }}" class="btn join-item w-1/3 text-cyan-600">
                        <i class="fa-regular fa-comment-dots"></i>
                    </a>
                    <button class="btn join-item w-1/3 text-blue-600">
                        <i class="fa-solid fa-share-nodes"></i>
                    </button>
                </div>
            </div>

        </div>


    </div>


</div>
