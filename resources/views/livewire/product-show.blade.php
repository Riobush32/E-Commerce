<div class="my-5 grid grid-cols-4 gap-5">
    @forelse ($products as $product)
        <a href="{{ route('productDetails', ['id' => $product->id]) }}"
            class="overflow-hidden rounded-3xl shadow-lg bg-slate-100 raltive hover:shadow-xl hover:bg-slate-200 hover:shadow-black hover:scale-105 duration-300 ease-in-out">
            {{-- discount  --}}
            <div class="absolute m-3 py-0.5 px-3 z-10 bg-red-600 rounded-full text-sm text-white">
                Sale 90% off
            </div>

            <div class="h-80 overflow-hidden ">
                @if ($product->product_photos->isNotEmpty())
                    <img src="{{ $product->product_photos->first()->photo_patch }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('img/bajuPria/gambar1.png') }}" alt="{{ $product->name }}">
                @endif
            </div>
            <div class="p-5 flex justify-between">
                <div class="">
                    <h1>{{ $product->name }} <div class="badge badge-white">NEW</div>
                    </h1>
                    <p class="text-primary text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    {{-- <p class="text-secondary line-through">Rp 245.000</p> --}}
                </div>
                <div class="text-xl text-red-600 hover:text-red-900 duration-300 ease-in-out cursor-pointer">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>
        </a>
    @empty
        <p class="col-span-4 text-center">No products available at the moment.</p>
    @endforelse



</div>
