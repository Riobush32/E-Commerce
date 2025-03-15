<section class="md:flex gap-4 w-full max-h-[510px] justify-center items-center overflow-hidden rounded-xl">
    {{-- main banner --}}

    <div class="carousel w-full">
        <div id="slide1" class="carousel-item relative w-full">
            <div style="background-image: url('{{ asset('img/modelBanner/banner-bg.jpg') }}')"
                class="md:w-3/4  flex flex-col-reverse md:flex-row items-end bg-cover justify-between max-h-[500px] bg-slate-100 shadow-inner rounded-xl overflow-hidden relative hover:bg-slate-200 ease-in-out duration-300">
                <div class="p-2 md:p-16 text-white md:w-2/3">
                    <h1 class="text-xl md:text-5xl ">Produk Terbaru dan Stylish</h1>
                    <p class="text-xs md:text-md mt-1 md:mt-2">
                        Temukan koleksi terbaru dengan desain terkini yang siap membuat penampilanmu semakin stylish.
                        Dapatkan
                        produk berkualitas dengan harga yang terjangkau!
                    </p>
                    <div class="mt-2">
                        <a href="{{ route('allProduct') }}"
                            class="btn btn-sm md:btn-md btn-primary text-white tracking-wide">Mulai Belanja</a>
                    </div>
                </div>
                <figure class="h-full flex flex-end md:w-1/3 ">
                    <img class="h-full w-auto object-cover" src="{{ asset('img/modelBanner/sekawan.jpg') }}"
                        alt="">
                </figure>
            </div>

            {{-- banner ke 2  --}}

            <div class="hidden w-1/3 m-1 gap-4 py-5 content-between md:grid grid-cols-1 h-full">
                @if ($Banner != null)
                    @foreach ($Banner as $index => $item)
                        <a href="{{ route('productDetails', ['id' => $item->id]) }}"
                            style="background-image: url('{{ asset('img/modelBanner/banner-bg.jpg') }}')"
                            class="bg-cover cursor-pointer shadow-inner bg-slate-100 flex justify-between h-[210px] items-center overflow-hidden rounded-xl  hover:bg-slate-200 ease-in-out duration-300">
                            <div class="w-1/2 pl-5 mt-8 z-10 text-white">
                                <h1 class="text-xl mb-3">{{ $item->name }}</h1>
                                {{-- <p class="text-primary text-xl font-bold tracking-wide">Rp {{ number_format(($item->price*90/100)) }}</p> --}}
                                <p class="text-primary text-xl font-bold tracking-wide">Rp
                                    {{ number_format($item->price) }}
                                </p>
                                <p class="text-neutral line-through">
                                <div class="rating rating-xs">
                                    <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                        aria-label="1 star" {{ $item->coments->avg('rating') >= 1 ? 'checked' : ''}} disabled />
                                    <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                        aria-label="2 star" {{ $item->coments->avg('rating') >= 2 ? 'checked' : ''}} disabled/>
                                    <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                        aria-label="3 star" {{ $item->coments->avg('rating') >= 3 ? 'checked' : ''}} disabled/>
                                    <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                        aria-label="4 star" {{ $item->coments->avg('rating') >= 4 ? 'checked' : ''}} disabled/>
                                    <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                        aria-label="5 star" {{ $item->coments->avg('rating') >= 5 ? 'checked' : ''}} disabled/>
                                </div></p>
                            </div>
                            <figure class="w-1/2">
                                <img class="h-full object-right-bottom"
                                    src="{{ asset($item->product_photos->first()->photo_patch) }}" alt="">
                            </figure>
                        </a>
                        @if ($index == 1)
                            @break
                        @endif
                    @endforeach
                @else
                    <div style="background-image: url('{{ asset('img/modelBanner/banner-bg.jpg') }}')"
                        class="bg-cover shadow-inner m-1 bg-slate-100 flex max-h-[210px] items-center overflow-hidden rounded-xl  hover:bg-slate-200 ease-in-out duration-300">
                        <div class="w-2/3 pl-5 mt-8 z-10">
                            <h1 class="text-xl mb-3">Lorem ipsum dolo.</h1>
                            <p class="text-primary text-xl font-bold tracking-wide">Rp 200.000,00</p>
                            <p class="text-neutral line-through">Rp 248.900,00</p>
                        </div>
                        <figure class="">
                            <img class="w-auto object-right-bottom" src="{{ asset('img/modelBanner/model3.png') }}"
                                alt="">
                        </figure>
                    </div>

                    {{-- banner ke 3  --}}
                    <div style="background-image: url('{{ asset('img/modelBanner/banner-bg.jpg') }}')"
                        class="bg-cover shadow-inner m-1 bg-slate-100 flex max-h-[210px] items-center overflow-hidden rounded-xl justify-items-stretch hover:bg-slate-200 ease-in-out duration-300">
                        <div class="w-2/3 pl-5 mt-8 z-10">
                            <h1 class="text-xl mb-3">Lorem ipsum dolo.</h1>
                            <p class="text-primary text-xl font-bold tracking-wide">Rp 200.000,00</p>
                            <p class="text-neutral line-through">Rp 248.900,00</p>
                        </div>
                        <figure class="">
                            <img class="w-auto object-right-bottom" src="{{ asset('img/modelBanner/model2.png') }}"
                                alt="">
                        </figure>
                    </div>
                @endif
            </div>
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide2" class="btn btn-circle">❮</a>
                <a href="#slide2" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide2" class="carousel-item relative w-full">
            <img src="{{ asset('img/modelBanner/toko.jpg') }}" class="w-full max-h-[500px]" />
            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                <a href="#slide1" class="btn btn-circle">❮</a>
                <a href="#slide1" class="btn btn-circle">❯</a>
            </div>
        </div>
    </div>

</section>
