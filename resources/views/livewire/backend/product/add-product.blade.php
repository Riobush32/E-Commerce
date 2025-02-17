<div @click.outside="formAddProduct=false">
    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    <div class="ralative card bg-base-100 w-[800px] shadow-xl">
        <button @click="formAddProduct = false" class="absolute top-5 right-5 btn btn-circle btn-outline btn-xs">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <form wire:submit="saveNewProduct" class="card-body max-h-[70vh] overflow-auto">
            <h2 class="card-title">Add New Product</h2>
            <div class="">
                <div class="flex flex-col gap-4 mt-3 w-1/2">
                    <div class="flex items-center gap-4 justify-between w-full">
                        <div class="flex items-center">
                            Nama Product
                        </div>
                        <div class="">
                            <label class="input input-sm input-bordered flex items-center gap-2">
                                <i class="fa-solid fa-shirt w-3 mr-1"></i>
                                <input wire:model.live="name" type="text" class="grow w-40"
                                    placeholder="Product name" />
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 justify-between w-full">
                        <div class="flex items-center">
                            Harga
                        </div>
                        <div class="">
                            <label class="input input-sm input-bordered flex items-center gap-2">
                                <i class="fa-solid fa-dollar-sign w-3 mr-1"></i>
                                <input wire:model.live="price" oninput="formatCurrency(this)" class="grow w-40"
                                    placeholder="Price" />
                                @error('price')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 justify-between w-full">
                        <div class="flex items-center">
                            Kategori
                        </div>
                        <select wire:model.live="category" class="select select-sm select-bordered w-52">
                            <option disabled selected>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex items-center gap-4 justify-between w-full">
                        <div class="flex items-center">
                            Brand
                        </div>
                        <select wire:model.live="brand" class="select select-sm select-bordered w-52">
                            <option disabled selected>Choose Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" class="bg-white" id="content" wire:model.live="description">
                    <input type="hidden" class="bg-white" id="content2" wire:model.live="info">
                </div>
                <div class="" wire:ignore>
                    <div class="mt-3">
                        <h1>Description</h1>
                        <div id="editor"></div>
                    </div>
                    <div class="mt-3">
                        <h1>Info</h1>
                        <div id="editorInfo"></div>
                    </div>

                </div>

            </div>

            <div class="card-actions justify-end">
                <button type="submit"
                    class="btn btn-sm text-white tracking-widest font-light btn-primary">Save</button>
            </div>
        </form>
    </div>

</div>
