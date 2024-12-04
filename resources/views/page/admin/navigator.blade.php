<div class=" h-16 bg-white px-10 flex gap-9 justify-center items-center rounded-xl" x-data="{ active: true }">
    {{-- home  --}}
    <a class="group text-center cursor-pointer relative flex items-center justify-center">
        <div :class="active ?
            'navigation-active' : ''" class="navigation">
            <i class="fa-solid fa-house  group-hover:rotate-12"></i>
        </div>
        <h1 :class="active ? 'scale-100 transition-all translate-y-2' : ''"
            class="scale-0 group-hover:scale-100 transition-all group-hover:translate-y-2 ">Home</h1>
    </a>
    {{-- user  --}}
    <a class="group text-center cursor-pointer relative flex items-center justify-center">
        <div class="navigation">
            <i class="fa-solid fa-user  group-hover:rotate-12"></i>
        </div>
        <h1 class="scale-0 group-hover:scale-100 transition-all group-hover:translate-y-2">User</h1>
    </a>
    {{-- Product  --}}
    <a class="group text-center cursor-pointer relative flex items-center justify-center">
        <div class="navigation">
            <i class="fa-solid fa-shirt group-hover:rotate-12"></i>
        </div>
        <h1 class="scale-0 group-hover:scale-100 transition-all group-hover:translate-y-2">Product</h1>
    </a>
    {{-- stok  --}}
    <a class="group text-center cursor-pointer relative flex items-center justify-center">
        <div class="navigation">
            <i class="fa-solid fa-cubes-stacked  group-hover:rotate-12"></i>
        </div>
        <h1 class="scale-0 group-hover:scale-100 transition-all group-hover:translate-y-2">Stok</h1>
    </a>
    {{-- order --}}
    <a class="group text-center cursor-pointer relative flex items-center justify-center">
        <div class="navigation">
            <i class="fa-solid fa-basket-shopping  group-hover:rotate-12"></i>
        </div>
        <h1 class="scale-0 group-hover:scale-100 transition-all group-hover:translate-y-2">Order</h1>
    </a>
    {{-- shipping  --}}
    <a class="group text-center cursor-pointer relative flex items-center justify-center">
        <div class="navigation">
            <i class="fa-solid fa-truck-fast  group-hover:rotate-12"></i>
        </div>
        <h1 class="scale-0 group-hover:scale-100 transition-all group-hover:translate-y-2">Shipping</h1>
    </a>





</div>
