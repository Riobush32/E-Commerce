<div class="my-5 grid grid-cols-4 gap-5">
    @forelse ($products as $product)
        @if ($product->stock > 0)
            <a href="{{ route('productDetails', ['id' => $product->id]) }}"
                class="overflow-hidden rounded-3xl shadow-lg bg-slate-100 raltive hover:shadow-xl hover:bg-slate-200 hover:shadow-black hover:scale-105 duration-300 ease-in-out">
                {{-- discount  --}}
                {{-- <div class="absolute m-3 py-0.5 px-3 z-10 bg-red-600 rounded-full text-sm text-white">
                Sale 90% off
            </div> --}}

                <div class="h-80 overflow-hidden ">
                    @if ($product->product_photos->isNotEmpty())
                        <img class="w-full" src="{{ asset($product->product_photos->first()->photo_patch) }}"
                            alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('img/bajuPria/gambar1.png') }}" alt="{{ $product->name }}">
                    @endif
                </div>
                <div class="p-5 flex justify-between">
                    <div class="">
                        <h1>{{ $product->name }} <div class="badge badge-white">NEW</div>
                        </h1>
                        <p class="text-primary text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-secondary line-through">
                        <div class="rating rating-xs">
                            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                aria-label="1 star" {{ $product->coments->avg('rating') >= 1 ? 'checked' : '' }}
                                disabled />
                            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                aria-label="2 star" {{ $product->coments->avg('rating') >= 2 ? 'checked' : '' }}
                                disabled />
                            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                aria-label="3 star" {{ $product->coments->avg('rating') >= 3 ? 'checked' : '' }}
                                disabled />
                            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                aria-label="4 star" {{ $product->coments->avg('rating') >= 4 ? 'checked' : '' }}
                                disabled />
                            <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                aria-label="5 star" {{ $product->coments->avg('rating') >= 5 ? 'checked' : '' }}
                                disabled />
                        </div>
                        </p>
                    </div>
                    <div class="text-xl text-red-600 hover:text-red-900 duration-300 ease-in-out cursor-pointer">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
            </a>
        @endif
    @empty
        <p class="col-span-4 text-center">No products available at the moment.</p>
    @endforelse



</div>
