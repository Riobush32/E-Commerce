<div class="card bg-base-100  shadow-xl mb-96">
    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    <div class="card-body">
        <div class="flex items-center gap-4">
            <h2 class="card-title">Brand List</h2>
            <button @click="formAddBrand = true" class="btn btn-outline btn-xs btn-success">add new</button>
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
                            <th>No</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($brands as $index => $brand)
                            <tr  wire:key="brand-{{ $brand->id }}">
                                <th>{{ $brands->firstItem() + $index }}</th>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    <button wire:click="$dispatch('toggleShowEditBrand', { id: {{ $brand->id }} })"
                                        class="btn btn-outline btn-info btn-xs">
                                        <i class="fa-solid fa-pen-to-square"></i> edit
                                    </button>
                                    <button wire:click="deleteBrand({{ $brand->id }})"
                                        class="btn btn-outline btn-error btn-xs">
                                        <i class="fa-solid fa-trash"></i> delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div wire:ignore class="hidden md:flex justify-end mt-4">
                    {{ $brands->links('backend.components.pagination') }}
                </div>
                <div  wire:ignore class="mt-4 md:hidden">
                    {{ $brands->links('backend.components.simple-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
