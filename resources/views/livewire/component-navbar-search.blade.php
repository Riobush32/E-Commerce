<div x-data="{ avatar: false }">
    {{-- vinta manullang  --}}
    <div class="w-full flex items-center justify-arund gap-2 px-16 py-2">
        <div class="font-logo font-bold text-xl w-1/6 flex items-center text">
            Vinta Manullang
        </div>
        <div class="w-3/6 flex items-center justify-center">
            <div class="join">
                <div>
                    <div>
                        <input class="w-[33vw] input input-sm input-bordered join-item" placeholder="Search" />
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

            <a class="link link-hover">Blog</a>
            <a class="link link-hover">About</a>
            <span class="text-primary">|</span>
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
                <div class="avatar mr-3">
                    <div @click="avatar = !avatar"
                        class="ring-slate-700 ring-offset-base-100 w-6 rounded-full ring ring-offset-2 cursor-pointer hover:ring-primary hover:rotate-12 transition-all">
                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                    </div>
                </div>
            @endguest



        </div>

    </div>
    <div class="mt-2 absolute z-50 right-24 max-h-[50vh] overflow-auto rounded-xl" x-show="avatar"
        @click.outside="avatar = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">


        <div
            class="px-10 py-5 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <div class="flex flex-col items-center">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                    alt="Bonnie image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">Visual Designer</span>
                <div class="mt-2">
                    <a href="{{ route('logout') }} "
                        class="btn btn-ghost text-rose-300 border border-rose-400 hover:text-red-500 font-light tracking-widest"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        logout</a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
