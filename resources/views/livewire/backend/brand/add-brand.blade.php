<div @click.outside="formAddBrand=false">
    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    <div class="ralative card bg-base-100 max-w-[800px] shadow-xl">
        <button @click="formAddBrand = false" class="absolute top-5 right-5 btn btn-circle btn-outline btn-xs">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="card-body max-h-[70vh] overflow-auto">
            <div class="border-2 border-dashed border-green-600 rounded-xl p-2">
                <h2 class="card-title">Add New Brand</h2>
            </div>

            <form wire:submit.prevent="saveNewBrand" class="border-2 border-dashed border-green-600 rounded-xl p-4">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Brand Name</span>
                    </div>
                    <input wire:model.live="name" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                </label>
                <div class="w-full flex justify-end p-3">
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
