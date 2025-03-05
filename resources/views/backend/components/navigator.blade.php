<div class="flex gap-2 items-center justify-center bg-slate-200 p-2 rounded-xl">
    <div class="tooltip group" data-tip="Product">
        <a href="{{ route('backendProduct') }}" class="{{ $active == 'product' ? 'btn-md bg-primary':'group-hover:btn-md group-hover:bg-primary '}} btn btn-sm  glass  bg-gray-400 transition-all ease-in-out duration-300"><i class="{{ $active == 'product' ? 'text-gray-600 text-xl': 'group-hover:text-gray-600 group-hover:text-xl' }} fa-solid fa-shirt  text-gray-300  text-md  transition-all ease-in-out duration-300"></i></a>
    </div>
    <div  class="tooltip group" data-tip="Brand">
        <a href="{{ route('backendBrand') }}" class="{{ $active == 'brand' ? 'btn-md bg-red-800':'group-hover:btn-md group-hover:bg-red-800 '}} btn btn-sm  glass  bg-gray-400 transition-all ease-in-out duration-300"><i class="{{ $active == 'brand' ? 'text-gray-50 text-xl': 'group-hover:text-gray-50 group-hover:text-xl ' }} fa-brands fa-slack  text-gray-300  text-md  transition-all ease-in-out duration-300"></i></a>
    </div>
    <div  class="tooltip group" data-tip="Category">
        <a href="{{ route('backendCategory') }}" class="{{ $active == 'category' ? 'btn-md bg-rose-500':'group-hover:btn-md group-hover:bg-rose-500 '}} btn btn-sm  glass  bg-gray-400 transition-all ease-in-out duration-300"><i class="{{ $active == 'category' ? 'text-gray-50 text-xl': 'group-hover:text-gray-50 group-hover:text-xl ' }} fa-solid fa-icons  text-gray-300  text-md  transition-all ease-in-out duration-300"></i></a>
    </div>
    <div  class="tooltip group" data-tip="Transaction">
        <a href="{{ route('backendTransaction') }}" class="{{ $active == 'transaction' ? 'btn-md bg-yellow-500':'group-hover:btn-md group-hover:bg-yellow-500 '}} btn btn-sm  glass  bg-gray-400 transition-all ease-in-out duration-300"><i class="{{ $active == 'transaction' ? 'text-gray-50 text-xl': 'group-hover:text-gray-50 group-hover:text-xl ' }} fa-solid fa-money-check-dollar  text-gray-300  text-md  transition-all ease-in-out duration-300"></i></a>
    </div>
    <div  class="tooltip group" data-tip="Chat">
        <a href="{{ route('backendChat') }}" class="{{ $active == 'Chat' ? 'btn-md bg-green-500':'group-hover:btn-md group-hover:bg-yellow-500 '}} btn btn-sm  glass  bg-gray-400 transition-all ease-in-out duration-300"><i class="{{ $active == 'Chat' ? 'text-gray-50 text-xl': 'group-hover:text-gray-50 group-hover:text-xl ' }} fa-solid fa-comments  text-gray-300  text-md  transition-all ease-in-out duration-300"></i></a>
    </div>
</div>
