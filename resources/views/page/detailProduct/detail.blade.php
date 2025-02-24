<div class="w-2/5 p-5">
    <div class="">

        {{-- nama brand --}}
        <h1 class="text-primary">{{ $product->brand->name }}</h1>
        {{-- nama Product  --}}
        <h2 class="text-2xl">{{ $product->name }}</h2>
        {{-- rating  --}}
        <div class="text-sm align-midle mt-2">
            <i class="fa-solid fa-star text-amber-500"></i>
            <span class="text-secondary">{{ $coments->avg('rating') }} Ratings</span>
            <span class="text-secondary">●</span>
            <span class="text-secondary">{{ $coments->count() }} sold</span>
        </div>
        <div class="mt-3">
            <h2 class="text-4xl">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
        </div>
    </div>
    {{-- descripsi dan info --}}
    <div class="" x-data="{ description: true, info: false }">
        <div class="flex gap-0 mt-5 ">
            <div class="py-2 px-3 cursor-pointer" :class="description ? 'text-primary' : ''"
                @click="description=true, info=false">
                Description
            </div>
            <div class="py-2 px-3  cursor-pointer" :class="info ? 'text-primary' : ''"
                @click="description=false, info=true">
                Info
            </div>
        </div>
        <hr>
        {{-- description  --}}
        <div class="px-2 py3 mt-5" x-show="description">
            {!! $product->description !!}
        </div>
        {{-- info  --}}
        <div class="px-2 py3 mt-5" x-show="info">
            {!! $product->info !!}
        </div>
    </div>
</div>
