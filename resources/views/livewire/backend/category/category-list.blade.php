<div class="card bg-base-100  shadow-xl mb-96">
    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    <div class="card-body">
        <div class="flex items-center gap-4">
            <h2 class="card-title">Category List</h2>
            <button @click="formAddCategory = true" class="btn btn-outline btn-xs btn-success">add new</button>
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
                            <th>Icon</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($categories as $index => $category)
                            <tr  wire:key="category-{{ $category->id }}">
                                <th>{{ $categories->firstItem() + $index }}</th>
                                <td>{{ $category->name }}</td>
                                <td><i class="fa-solid {{ $category->icon->name }}"></i></td>
                                <td>
                                    <button wire:click="$dispatch('toggleShowEditCategory', { id: {{ $category->id }} })"
                                        class="btn btn-outline btn-info btn-xs">
                                        <i class="fa-solid fa-pen-to-square"></i> edit
                                    </button>
                                    <button wire:click="deleteCategory({{ $category->id }})"
                                        class="btn btn-outline btn-error btn-xs">
                                        <i class="fa-solid fa-trash"></i> delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div wire:ignore class="hidden md:flex justify-end mt-4">
                    {{ $categories->links('backend.components.pagination') }}
                </div>
                <div  wire:ignore class="mt-4 md:hidden">
                    {{ $categories->links('backend.components.simple-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
