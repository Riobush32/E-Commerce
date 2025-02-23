<div>

    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    @if ($showStatus)
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="ralative card bg-base-100 max-w-[800px] shadow-xl">
            <button wire:click="$set('showEditCategory', false)"
                class="absolute top-5 right-5 btn btn-circle btn-outline btn-xs">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="card-body max-h-[70vh] overflow-auto">
                <div class="border-2 border-dashed border-green-600 rounded-xl p-2">
                    <h2 class="card-title">Update Status</h2>
                </div>

                <form wire:submit.prevent="updateCategoryData"
                    class="border-2 border-dashed border-green-600 rounded-xl p-4">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Status {{ $transactionData->status }}</span>
                        </div>
                        <select class="select select-bordered select-sm w-full max-w-xs">
                            <option value="{{ $status }}">
                                {{ $statusText }}
                            </option>
                            <option value="1">Pesanan Diproses</option>
                            <option value="2">Pesanan DiPacking</option>
                            <option value="3">Pesanan Dikirim</option>
                            <option Value="4">Pesanan Diterima</option>
                            <option Value="5">Pesanan Selesai</option>
                        </select>
                    </label>

                    <div class="w-full flex justify-end p-3">
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @endif
</div>
