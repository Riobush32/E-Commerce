<nav class="w-full px-5 mt-3">
    <div class="navbar bg-base-100 shadow-lg rounded-3xl border">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Vinta Manulang</a>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="badge badge-sm indicator-item">{{ $notifications->count() }}</span>
                    </div>
                </div>
                <div tabindex="0" class="card card-compact dropdown-content bg-base-100 z-[1] mt-3 w-96 shadow">
                    <div class="card-body">
                        <span class="text-lg font-bold">{{ $notifications->count() }} Items</span>
                        <div class="">
                            @foreach ($notifications as $item)
                                <div role="alert" class="alert shadow-lg my-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="stroke-info h-6 w-6 shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-bold">Pesanan Baru!</h3>
                                        <div class="text-xs">
                                            <span class="text-yellow-700">{{ $item->user->name }}</span>
                                            Ingin Membeli
                                            <span class="text-rose-700">{{ $item->cart->quantity }}
                                                {{ $item->cart->variant->product->name }}</span> variant
                                            <span class="text-green-700">{{ $item->cart->variant->name }}</span>
                                        </div>
                                    </div>
                                    <a wire:click="$dispatch('updateSearchTransactionList', { order_number: '{{ $item->order_number }}' })" class="btn btn-sm">See</a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="https://tse4.mm.bing.net/th?id=OIP.ZE2YEvUMEQOyT13WVMHKtwAAAA&pid=Api&P=0&h=180" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
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
</nav>
