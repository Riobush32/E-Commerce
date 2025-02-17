<div>
    @if ($showDetailProduct)
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="card bg-base-100 w-[900px] shadow-xl h-[70vh] p-5 overflow-auto">
                <div class="card-body ">
                    <div class="flex justify-between items-center">
                        <div class="">
                            <label class="swap swap-flip text-2xl">
                                <!-- this hidden checkbox controls the state -->
                                <input type="checkbox" wire:click="toogleEditing()" />

                                <div class="swap-on text-center ">
                                    <div class="p-2 rounded-lg bg-cyan-400">
                                        <div class="">
                                            <h1 class="text-2xl">Edit Product</h1>
                                            <h6 class="text-xs"> switch to detail</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="swap-off text-center ">
                                    <div class="p-2 rounded-lg bg-amber-400">
                                        <div class="">
                                            <h1 class="text-2xl">Details Product</h1>
                                            <h6 class="text-xs"> switch to Edit</h6>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <button wire:click="$set('showDetailProduct',false)"
                            class="btn btn-circle btn-xs btn-error group btn-outline">
                            <i class="fa-solid fa-xmark group-hover:text-white"></i>
                        </button>
                    </div>

                    <div class="mt-3 flex gap-8">
                        {{-- //////////////////////////////////////////////////////////////////////////////// --}}
                        <form class="w-1/3" form wire:submit.prevent="updateProduct">
                            <div class="flex gap 4 mt-2 justify-between">
                                <div class="{{ $editing ? 'text-cyan-400' : 'text-amber-400' }}">
                                    Nama Product
                                </div>
                                @if ($editing)
                                    <div class="w-1/2">
                                        <input wire:model.live="name" type="text" placeholder="Type here"
                                            class="input input-ghost input-xs w-full text-end text-sm"
                                            value="{{ $productDetailData->name }}" />
                                    </div>
                                @else
                                    <div class="">
                                        {{ $productDetailData->name }}
                                    </div>
                                @endif
                            </div>
                            <hr class="border border-slate-300">
                            <div class="flex gap 4 mt-2 justify-between">
                                <div class="{{ $editing ? 'text-cyan-400' : 'text-amber-400' }}">
                                    Harga
                                </div>

                                @if ($editing)
                                    <div class="w-1/2">
                                        <input wire:model.live="price" type="text" placeholder="Type here"
                                            class="input input-ghost input-xs w-full text-end text-sm"
                                            value="{{ $productDetailData->price }}" oninput="formatCurrency(this)" />
                                    </div>
                                @else
                                    <div class="">
                                        Rp {{ number_format($productDetailData->price, 0, '', '.') }}
                                    </div>
                                @endif

                            </div>
                            <hr class="border border-slate-300">
                            <div class="flex gap 4 mt-2 justify-between">
                                <div class="{{ $editing ? 'text-cyan-400' : 'text-amber-400' }}">
                                    Kategori
                                </div>
                                @if ($editing)
                                    <div class="w-1/2">
                                        <select wire:model.live="categoryId"
                                            class="select select-ghost w-full select-xs text-sm text-end">
                                            <option selected value="{{ $productDetailData->category->id }}">
                                                {{ $productDetailData->category->name }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="">
                                        {{ $productDetailData->category->name }}
                                    </div>
                                @endif
                            </div>
                            <hr class="border border-slate-300">
                            <div class="flex gap 4 mt-2 justify-between">
                                <div class="{{ $editing ? 'text-cyan-400' : 'text-amber-400' }}">
                                    Brand
                                </div>
                                @if ($editing)
                                    <div class="w-1/2">
                                        <select wire:model.live="brandId"
                                            class="select select-ghost w-full select-xs text-sm text-end ">
                                            <option selected value=" {{ $productDetailData->brand->id }}">
                                                {{ $productDetailData->brand->name }}</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="">
                                        {{ $productDetailData->brand->name }}
                                    </div>
                                @endif
                            </div>
                            <hr class="border border-slate-300">
                            <div class="flex gap 4 mt-2 justify-between">
                                <div class="{{ $editing ? 'text-cyan-400' : 'text-amber-400' }}">
                                    Stok
                                </div>
                                <div class="">
                                    {{ $productDetailData->variants->sum('stok') }}
                                </div>
                            </div>
                            <hr class="border border-slate-300">
                            <div class="flex gap 4 mt-2 justify-between">
                                <div class="{{ $editing ? 'text-cyan-400' : 'text-amber-400' }}">
                                    Sold
                                </div>
                                <div class="">
                                    {{ $productDetailData->sold }}
                                </div>
                            </div>
                            <hr class="border border-slate-300">
                            <div class="flex gap 4 mt-2 justify-between">
                                <div class="{{ $editing ? 'text-cyan-400' : 'text-amber-400' }}">
                                    Rating
                                </div>
                                <div class="">
                                    <div class="rating rating-xs">
                                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                            disabled />
                                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                            disabled />
                                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                            disabled />
                                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                            checked="checked" disabled />
                                        <input type="radio" name="rating-5" class="mask mask-star-2 bg-orange-400"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                            @if ($editing)
                                <div class="p-3">
                                    <button type="submit"
                                        class="btn btn-wide btn-sm text-white text-lg font-light tracking-wide btn-info">update</button>
                                </div>
                            @endif
                        </form>
                        {{-- //////////////////////////////////////////////////////////////////////////////// --}}
                        <form wire:submit.prevent="saveImage" enctype="multipart/form-data" class="w-2/3 z-[9999]">
                            <div>
                                <label id="dropzone"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer border-gray-600 hover:border-gray-500 bg-cover bg-center "
                                    style="background-image: url('{{ $productImage ? $productImage->temporaryUrl() : '' }}');">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                            800x400px)</p>
                                        <input type="file" wire:model="productImage" id="fileInput"
                                            class="hidden" accept="image/*">
                                    </div>

                                </label>
                            </div>

                            <div class="flex w-full justify-end">
                                <button type="submit" class="mt-5 btn btn-sm btn-outline">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 m-3">Product Images</h3>
                <div class="columns-4 gap-4 p-2 mt-3">

                    @foreach ($productDetailData->product_photos as $photo)
                        <div
                            class="relative border-2 border-dashed {{ $editing ? 'border-sky-600' : 'border-amber-600' }}  p-1 rounded-xl overflow-hidden ">
                            <button wire:click="deletePhotoProduct({{ $photo->id }})"
                                class="absolute top-1 right-1 z-[9999] btn  btn-xs btn-error btn-circle text-white text-xs {{ $editing ? 'border-sky-600' : 'hidden' }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <img class="" src="{{ asset($photo->photo_patch) }}" alt="">
                        </div>
                    @endforeach
                </div>
                {{-- ///////////////////////////////////////////////////////////-----Varian-----------////////////////////////////////////////////////////////// --}}
                <div class="mt-3">
                    <div class="">
                        <h3 class="text-xl font-semibold text-gray-800 m-3">Variant</h3>
                        <div class="flex flex-wrap gap-4 ">
                            @foreach ($productDetailData->variants as $variant)
                                <div
                                    class="relative flex gap-4 items-center p-2 border-2 border-dashed border-emerald-700 rounded-lg {{ $editing ? 'border-sky-600' : 'border-amber-600' }}">
                                    <div class="avatar">
                                        <div class="w-20 rounded">
                                            <img src="{{ asset($variant->variant_image) }}" alt="varian image" />
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="text-left text-lg text-primary">
                                            {{ $variant->name }}
                                        </p>
                                        @if ($editing)
                                            <div class="join">
                                                <button wire:click="decrementVariantStok({{ $variant->id }})"
                                                    class="join-item btn btn-xs">-</button>
                                                <input value="{{ $variant->stock }}"
                                                    class="text-center join-item input-xs w-10 bg-transparent border"
                                                    type="text" readonly />
                                                <button wire:click="incrementVariantStok({{ $variant->id }})"
                                                    class="join-item btn btn-xs">+</button>
                                            </div>
                                        @else
                                            <span class="text-sm">Stok
                                                {{ $variant->stock == null ? 'kosong' : $variant->stock }}</span>
                                        @endif



                                    </div>

                                    <button wire:click="deleteVariant({{ $variant->id }})"
                                        class="absolute top-1 right-1 z-[9999] btn  btn-xs btn-error btn-circle text-white text-xs {{ $editing ? 'border-sky-600' : 'hidden' }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex w-full justify-end mt-3">
                        <button wire:click="toogleVariantAdd()" class="btn btn-ghost btn-xs text-primary"><i
                                class="fa-solid fa-plus "></i> add
                            variant</button>
                    </div>
                    @if ($showVariantProduct)
                        <form wire:submit.prevent="saveVariant" enctype="multipart/form-data"
                            class="p-3 border border-dashed border-fuchsia-500 rounded-xl">
                            <div class="flex items-center w-full gap-4 ">
                                <div class="w-1/5 ">
                                    <label id="dropzoneVariant"
                                        class="flex flex-col items-center justify-center w-full border-2 border-dashed rounded-lg cursor-pointer border-gray-600 hover:border-gray-500 bg-cover bg-center "
                                        style="background-image: url('{{ $variantImage ? $variantImage->temporaryUrl() : '' }}');">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 text-center"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <input type="file" wire:model="variantImage" id="variantInput"
                                                class="hidden" accept="image/*">
                                        </div>

                                    </label>
                                </div>
                                <div class="w-4/5">
                                    <label class="form-control w-full max-w-xs">
                                        <div class="label">
                                            <span class="label-text">Nama Variant</span>
                                        </div>
                                        <input wire:model.live="variantName" type="text" placeholder="Type here"
                                            class="input input-bordered w-full max-w-xs" />
                                    </label>
                                    <label class="form-control w-full max-w-xs">
                                        <div class="label">
                                            <span class="label-text">Berat</span>
                                        </div>
                                        <input wire:model.live="variantWeight" step="0.001" type="number"
                                            placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                                    </label>
                                </div>
                            </div>
                            <div class="flex w-full justify-end mt-2">
                                <button type="submit" class="btn btn-outline btn-accent">save</button>
                            </div>
                        </form>
                    @endif

                </div>
                {{-- /////////////////////////////////////////---------End Varian---------///////////////////////////////////////////////////////// --}}
                <div class="flex gap-4 mb-10 w-full">
                    <form wire:submit.prevent="updateDescription" class="mt-3">
                        <input type="hidden" value="{{ $productDetailData->description }}"   class="bg-white" id="contentEditDescription"
                            wire:model.live="editDescription">

                        <input type="hidden" value="{{ $productDetailData->info }}" class="bg-white" id="contentEditInfo" wire:model.live="editInfo">
                        <div class="" wire:ignore>
                            <div class="mt-3">
                                <h1>Description</h1>
                                <div id="editorEditDescription">
                                    {!! $productDetailData->description !!}
                                </div>
                            </div>
                            <div class="mt-3">
                                <h1>Info</h1>
                                <div id="editorEditInfo">
                                    {!! $productDetailData->info !!}
                                </div>
                            </div>

                        </div>
                        <div class="w-full flex justify-end mt-3 mr-5">
                            <button type="submit" class="btn btn-sm btn-info">update <span class="text-white">edit or info</span> </button>
                        </div>
                    </form>
                </div>


            </div>
        </div>

    @endif
</div>
