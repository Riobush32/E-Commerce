<div>

    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    @if ($showEditCategory)
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="ralative card bg-base-100 max-w-[800px] shadow-xl">
                <button wire:click="$set('showEditCategory', false)"
                    class="absolute top-5 right-5 btn btn-circle btn-outline btn-xs">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="card-body max-h-[70vh] overflow-auto">
                    <div class="border-2 border-dashed border-green-600 rounded-xl p-2">
                        <h2 class="card-title">Update Category</h2>
                    </div>

                    <form wire:submit.prevent="updateCategoryData"
                        class="border-2 border-dashed border-green-600 rounded-xl p-4">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Category Name</span>
                            </div>
                            <input wire:model.live="name" type="text" placeholder="Type here"
                                class="input input-bordered w-full max-w-xs" />
                        </label>
                        <div class="mx-auto bg-white rounded-lg shadow-lg p-2">
                            <!-- Radio Inputs Container -->
                            <h1 class="font-lg my-3">Icon</h1>
                            <div class="flex gap-3 flex-wrap">
                                <!-- Radio 1 -->
                                @foreach ($icons as $index => $icon)
                                    <div class="flex items-center ">
                                        <input wire:model.live="iconId" value="{{ $icon->id }}" type="radio"
                                            id="radio{{ $index }}" name="radio" class="hidden peer" />
                                        <label for="radio{{ $index }}"
                                            class="flex items-center cursor-pointer peer-checked:bg-fuchsia-600 peer-checked:text-white px-2 py-1 bg-gray-200 rounded-lg">
                                            <span><i class="fa-solid {{ $icon->name }}"></i></span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="w-full flex justify-end p-3">
                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
</div>
