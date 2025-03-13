<div class="card bg-base-100  shadow-xl mb-96">
    <div class="card-body">
        <div class="flex items-center gap-4">
            <h2 class="card-title">Voucher List</h2>
            <button @click="formAddVoucher = true" class="btn btn-outline btn-xs btn-success">add new</button>
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
                            <th>Name</th>
                            <th>Poin Required</th>
                            <th>Validated</th>
                            <th>Minimal Purchase</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($vouchers as $voucher)
                            <tr wire:key="product-{{ $voucher->id }}">
                                <td>
                                    {{ $voucher->name }}
                                </td>
                                <td>
                                    {{ $voucher->points_required }}
                                </td>
                                <td>
                                    <p>From : <span class="text-green-400">{{ $voucher->valid_from }}</span></p>
                                    <p>Until : <span class="text-red-400">{{ $voucher->valid_until }}</span></p>
                                </td>
                                <td>
                                    Rp {{ number_format($voucher->min_purchase) }}
                                </td>
                                <td>
                                    @if($voucher->discount_type == 'percentage')
                                        <span class="text-yellow-400">{{ $voucher->discount_value }} %</span>
                                    @elseif($voucher->discount_type == 'fixed')
                                        <span class="text-sky-400">Rp {{ number_format($voucher->discount_value)  }}</span>
                                    @endif
                                </td>
                                <th>
                                    <button wire:click="$dispatch('toogleVoucherEdit', { id: {{ $voucher->id }} })"
                                        class="btn btn-outline btn-info btn-xs">
                                        <i class="fa-solid fa-pen-to-square"></i> edit
                                    </button>
                                    <button wire:click="deleteVoucher({{ $voucher->id }})"
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
                            <th>Name</th>
                            <th>Poin Required</th>
                            <th>Validated</th>
                            <th>Minimal Purchase</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="hidden md:flex justify-end mt-4">
                    {{ $vouchers->links('backend.components.pagination') }}
                </div>
                <div class="mt-4 md:hidden">
                    {{ $vouchers->links('backend.components.simple-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
