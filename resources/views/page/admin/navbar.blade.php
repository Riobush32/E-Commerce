<div class="fixed w-11/12" x-data="{ notif: false, avatar:false }">
    <div class="navbar bg-base-100 overflow-hidden rounded-xl px-4">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li><a>Item 1</a></li>
                    <li>
                        <a>Parent</a>
                        <ul class="p-2">
                            <li><a>Submenu 1</a></li>
                            <li><a>Submenu 2</a></li>
                        </ul>
                    </li>
                    <li><a>Item 3</a></li>
                </ul>
            </div>
            <a class="font-bold text-xl cursor-pointer hover:rotate-12 transition-all">daisyUi</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            
        </div>
        <div class="navbar-end gap-4">
            {{-- notification  --}}
            <div class="mr-2">
                <div class="indicator group" @click="notif = !notif">
                    <span
                        class="indicator-item badge badge-primary text-xs border-none group-hover:bg-cyan-600 group-hover:rotate-12">12</span>
                    <div
                        class="grid w-10 h-10 rounded-full  group-hover:rotate-12 bg-slate-700 text-white place-items-center group-hover:bg-primary transition-all cursor-pointer ">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                </div>
            </div>
            {{-- user  --}}
            <div class="avatar mr-3">
                <div @click="avatar = !avatar"
                    class="ring-slate-700 ring-offset-base-100 w-8 rounded-full ring ring-offset-2 cursor-pointer hover:ring-primary hover:rotate-12 transition-all">
                    <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                </div>
            </div>
        </div>
    </div>
    {{-- dropdown-menu notif --}}
    <div class="mt-2 absolute z-10 right-24 w-80 max-h-[50vh] overflow-auto rounded-xl" x-show="notif"
        @click.outside="notif = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        @for ($i = 0; $i < 10; $i++)
            <div class="alert shadow-lg mt-2 transition-all">
                <i class="fa-solid fa-circle-info text-blue-400 text-lg"></i>
                <div>
                    <h3 class="font-bold">New message!</h3>
                    <div class="text-xs">You have 1 unread message</div>
                </div>
                <button class="btn btn-sm hover:bg-red-700 hover:text-white transition-all"><i class="fa-solid fa-trash"></i></button>
            </div>
        @endfor

    </div>

    {{-- user dropdown  --}}
    <div class="mt-2 absolute z-10 right-24 max-h-[50vh] overflow-auto rounded-xl" x-show="avatar" 
        @click.outside="avatar = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">


        <div
            class="px-10 py-5 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            
            <div class="flex flex-col items-center">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                    alt="Bonnie image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">Bonnie Green</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">Visual Designer</span>
                
            </div>
        </div>

    </div>
</div>
