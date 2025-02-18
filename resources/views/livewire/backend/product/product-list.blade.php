<div class="card bg-base-100  shadow-xl mb-96">
    <div class="card-body">
        <div class="flex items-center gap-4">
            <h2 class="card-title">Product List</h2>
            <button @click="formAddProduct = true" class="btn btn-outline btn-xs btn-success">add new</button>
        </div>

        <div class="mt-3">
            <div class="flex px-5 gap-2 justify-between">
                <label class="input input-bordered input-sm flex items-center gap-2">
                    <input wire:model.live="search" type="text" class="grow" placeholder="Search" />
                </label>
                <select wire:model.live="perPage" class="select select-bordered select-sm ">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
            </div>

            <div class="overflow-x-auto mt-3">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Name & Price</th>
                            <th>Category & Brand</th>
                            <th>Stok</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($products as $product)
                            <tr wire:key="product-{{ $product->id }}">
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                @if (!empty($product->product_photos))
                                                    @foreach ($product->product_photos as $photo)
                                                        @if ($loop->first)
                                                            <img src="{{ asset($photo->photo_patch) }}"
                                                                alt="Product-photo" />
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <img src="{{ asset('img/bajuPria/siluet.jpg') }}"
                                                        alt="gambar sementara" />
                                                @endif

                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $product->name }}</div>
                                            <div class="text-sm opacity-50">Rp
                                                {{ number_format($product->price, 2, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                    <br />
                                    <span class="badge badge-ghost badge-sm">{{ $product->brand->name }}</span>
                                </td>
                                <td>
                                    @foreach ($product->variants as $variant)
                                    <div class="">
                                        <span class="text-primary">{{ $variant->name }}</span> :
                                        {{ $variant->stok != 0 || $variant->stok != null ? $variant->stok : 'kosong' }}
                                    </div>

                                    @endforeach
                                </td>
                                <th>
                                    <button wire:click="$dispatch('toggleDetailProduct', { id: {{ $product->id }} })"
                                        class="btn btn-outline btn-warning btn-xs">
                                        <i class="fa-solid fa-circle-info"></i> details
                                    </button>
                                    <button wire:click="deleteProduct({{ $product->id }})"
                                        class="btn btn-outline btn-error btn-xs">
                                        <i class="fa-solid fa-trash"></i> delete
                                    </button>

                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                    <!-- foot -->
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Favorite Color</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="hidden md:flex justify-end mt-4">
                    {{ $products->links('backend.components.pagination') }}
                </div>
                <div class="mt-4 md:hidden">
                    {{ $products->links('backend.components.simple-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
