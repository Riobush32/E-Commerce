<div class="w-1/5 p-5" x-data="{ subtotal: 1, productPrice: {{ $product->price }} }">
    <div
        class="bg-primary w-full text-white p-3 rounded-xl shadow-lg shadow-slate-400 hover:scale-105 hover:shadow-black ease-in-out duration-300">
        <div class="">
            <h1 class="text-md fontbold">20% Off</h1>
            <p class="text-xs text-slate-200">if order <span class="text-white">Rp 200.000</span></p>
        </div>
        <div class="text-sm text-right">
            <h2>Until Dec, 30 2024</h2>
        </div>
    </div>

    {{-- set order  --}}
    <form id="formCart" method="POST" class="p-3 mt-3 w-full border-[1px] border-primary rounded-xl shadow-lg" x-data="{ v: '' }">
        @csrf
        Set Order:
        @guest
            @else
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endguest

        <hr class="border-primary ">
        <div class="p-2 flex gap-4 items-center">
            <div class="w-1/4 rounded overflow-hidden">
                <img src="{{ asset('img/bajuPria/gambar1.png') }}" alt="">
            </div>
            <div class="">
                <p class="text-sm">selected variant</p>
                <p x-text="v"></p>
            </div>
        </div>

        {{-- variants  --}}
        @include('page.detailProduct.variant')

        {{-- count --}}
        jumlah
        <div x-data="{ count: 1 }">
            <button class="btn join-item text-lg font-bold"
                @click="count = Math.max(1, count - 1), subtotal=count">-</button>
            <input type="number" class="input w-24 join-item text-center" x-model.number="count" min="1" />
            <button class="btn join-item text-lg font-bold" @click="count++, subtotal=count">+</button>
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
            <textarea name="notes" x-show="catatan" id="message" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-primary focus:ring-primary focus:border-primary "
                placeholder="Tulis Catatanmu disini..."></textarea>
        </div>

        {{-- subtotal --}}
        <div class="items-center justify-between my-3">
            <div class="">subtotal</div>
            <div x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(subtotal * productPrice)"
                class="text-xs md:text-lg font-bold text-gray-900  w-full mb-2">Rp 1.000.000,00</div>
                <input type="hidden" name="quantity" :value="subtotal">

            <button type="button" onclick="submitForm('{{ route('addToCart') }}')"
                class="w-full text-white bg-gradient-to-r from-orange-500 via-orange-400 to-orange-300 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Add to cart
            </button>
            <button type="button"
                class="w-full text-primary hover:text-white border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg md:text-sm text-xs md:px-5 px-3 md:py-2.5 py-1 text-center md:me-2 me-1 md:mb-2 mb-1 ">
                Buy
            </button>
        </div>

        {{-- whislish  --}}
        <div class="flex justify-center">
            <div class="join join-vertical lg:join-horizontal w-full">
                <button class="btn join-item w-1/3 text-red-500">
                    <i class="fa-solid fa-heart"></i>
                </button>
                <button class="btn join-item w-1/3 text-cyan-600">
                    <i class="fa-regular fa-comment-dots"></i>
                </button>
                <button class="btn join-item w-1/3 text-blue-600">
                    <i class="fa-solid fa-share-nodes"></i>
                </button>
            </div>
        </div>

    </form>


    <script>
        function submitForm(action) {
            const form = document.getElementById('formCart');
            form.action = action;
            form.submit();
        }
    </script>
</div>

