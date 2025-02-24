<x-layouts-main>
    <x-flash-message></x-flash-message>


    <div class="flex">
        @include('page.detailProduct.image')
        @include('page.detailProduct.detail')
        @livewire('set-order', ['id' => $product->id])


    </div>
    <hr class="my-5">
    {{-- @include('page.detailProduct.rating-details') --}}

    <div class="grid grid-cols-3 gap-4 mt-10">
        @foreach ($coments as $coment)
            <div class="border p-5 rounded-3xl hover:scale-105 shadow-lg hover:shadow-black ease-in-out duration-300">
                @include('page.detailProduct.rating-coment')
            </div>
        @endforeach

    </div>

</x-layouts-main>
