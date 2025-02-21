<div x-data="{ avatar: false }" @click.outside="if(avatar) avatar = false">
    {{-- vinta manullang  --}}
    <div class="w-full flex items-center justify-arund gap-2 px-16 py-2">
        <a href="{{ route('home') }}" class="font-logo font-bold text-xl w-1/6 flex items-center text">
            Vinta Manullang
        </a>
        <div class="w-3/6 flex items-center justify-center">
            <div class="join">
                <div>
                    <div>
                        <input wire:model.live="search" class="w-[33vw] input input-sm input-bordered join-item"
                            placeholder="Search" />
                    </div>
                </div>
                <select class="select select-sm select-bordered join-item gruop">
                    <option disabled selected>All Category</option>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                        <option>category is null</option>
                    @endforelse
                </select>
                <button class="btn btn-sm btn-primary join-item text-white"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="w-2/6 flex items-center gap-5 justify-end">

            <div class="flex items-center">

                <div class="indicator mr-5">
                    @if ($cart != 0)
                        <div class="indicator-item bg-primary text-white text-[8px] rounded-full px-1 py-0.5 block">
                            {{ $cart }}
                        </div>
                    @endif

                    <a href="{{ route('cart') }}" class="btn btn-sm btn-ghost btn-primary flex items-center">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
                <button class="btn btn-sm btn-ghost btn-primary flex items-center">
                    <i class="fa-solid fa-bookmark"></i>
                </button>
            </div>
            @guest
                <a href="{{ route('login') }}"
                    class="btn btn-sm btn-primary text-white tracking-widest font-light">Login</a>
                <a href="{{ route('register') }}"
                    class="btn btn-sm btn-outline btn-primary text-white  tracking-widest font-light">register</a>
            @else
                {{-- user  --}}
                <div class="avatar mr-3 group" @click="avatar = true">
                    <div @click="avatar = true"
                        class="ring-slate-700 ring-offset-base-100 w-6 rounded-full ring ring-offset-2 cursor-pointer hover:ring-primary hover:rotate-12 transition-all">
                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
            @endguest



        </div>

    </div>
    @guest
    @else
        <div class="mt-2 absolute z-[999] right-24 max-h-[50vh] overflow-auto rounded-xl" x-show="avatar"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">


            <div
                class="px-10 py-5 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                <div class="flex flex-col items-center">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                        alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</h5>
                    <ul class="menu bg-transparent text-white rounded-box w-56">
                        <li class="hover:bg-slate-600 rounded-lg"> <a href="{{ route('shippingAddress') }}">Shipping
                                Address</a></li>
                        <li class="hover:bg-slate-600 rounded-lg"><a href="{{ route('transactionList') }}">Transactions</a>
                        </li>
                        <li class="hover:bg-slate-600 rounded-lg"><a href="{{ route('logout') }} "
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                logout</a>
                        </li>
                    </ul>
                    <form class="invisible" action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    @endguest

    {{-- ////////////////////////////////////////////// search Feedback /////////////////////////////////// --}}
    @if ($search != '')
        <div class="fixed w-full flex justify-center items-center ">
            <div class="flex max-h-[65vh] overflow-auto gap-4 flex-wrap max-w-[900px] mt-3 rounded-xl p-4 bg-slate-50 shadow-xl border">
                @foreach ($products as $product)
                    <a href="{{ route('productDetails', ['id' => $product->id]) }}" class="flex gap-2 cursor-pointer items-center border shadow-lg hover:shadow-black duration-300 ease-in-out rounded-xl p-3">
                        <div class="avatar">
                            <div class="mask rounded-xl w-16">
                                <img src="{{ asset($product->product_photos->first()->photo_patch) }}" />
                            </div>
                        </div>
                        <div class="">
                            <h1 class="font-semibold">{{ $product->name }}</h1>
                            <h3 class=font-light>Rp {{ number_format($product->price) }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
