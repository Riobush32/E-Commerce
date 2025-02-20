<div class="card bg-base-100  shadow-xl mb-96">
    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    <div class="card-body">
        <div class="flex items-center gap-4">
            <h2 class="card-title">Transaction List</h2>
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
                            <th>Order Number</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        {{-- @foreach ($transactions as $order_number => $orders) --}}
                        @foreach ($transactions as $transaction)

                            <tr >
                                <td>{{ $transaction->order_number }}</td>
                                <td>{{ $transaction->created_at  }}</td>
                                <td>{{ $transaction->status  }}</td>

                                <td>
                                    <button
                                        wire:click="$dispatch('toggleShowEdittransaction', { id: {{ $transaction->id }} })"
                                        class="btn btn-outline btn-info btn-xs">
                                        <i class="fa-solid fa-pen-to-square"></i> edit
                                    </button>
                                    <button wire:click="deletetransaction({{ $transaction->id }})"
                                        class="btn btn-outline btn-error btn-xs">
                                        <i class="fa-solid fa-trash"></i> delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @endforeach --}}

                    </tbody>
                </table>

                {{-- <div wire:ignore class="hidden md:flex justify-end mt-4">
                    {{ $transactions->links('backend.components.pagination') }}
                </div>
                <div wire:ignore class="mt-4 md:hidden">
                    {{ $transactions->links('backend.components.simple-pagination') }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
