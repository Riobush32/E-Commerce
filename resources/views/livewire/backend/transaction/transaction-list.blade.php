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
                {{-- <select wire:model.live="perPage" class="select select-bordered select-sm ">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select> --}}
                <form action="{{ route('backendTransactionPrint') }}" method="post" class="join">
                    @csrf
                    <label class="input input-sm input-bordered flex items-center gap-2 join-item">
                        Dari
                        <input name="dari" type="date" class="grow" required />
                    </label>
                    <label class="input  input-sm input-bordered flex items-center gap-2  join-item">
                        sampai
                        <input name="sampai" type="date" class="grow" required />
                    </label>
                    <button submit class="btn btn-sm  join-item">create laporan</button>
                </form>
            </div>
            <div class="overflow-x-auto mt-3">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orders as $orderNumber => $transactionsByOrder)
                            <tr>
                                <td>{{ $orderNumber }}</td>
                                <td>
                                    @foreach ($transactionsByOrder as $transaction)
                                        <button
                                            wire:click="$dispatch('toogleChangeStatus', { order_number: '{{ $transaction['order_number'] }}' })"
                                            class="btn btn-outline btn-info btn-xs">
                                            @if ($transaction['status'] == '1')
                                                Pesanan Diproses
                                            @elseif($transaction['status'] == '2')
                                                Pesanan DiPacking
                                            @elseif($transaction['status'] == '3')
                                                Pesanan Dikirim
                                            @elseif($transaction['status'] == '4')
                                                Pesanan Diterima
                                            @elseif($transaction['status'] == '5')
                                                Pesanan Selesai
                                            @endif
                                        </button>
                                    @break
                                @endforeach
                            </td>
                            <td>
                                @foreach ($transactionsByOrder as $transaction)
                                    @php
                                        $variantId = $transaction['cart']['variant_id'];
                                        $variant = \App\Models\Variant::find($variantId);
                                    @endphp
                                    <div class="flex gap-4 m-2 items-center">
                                        <div class="">
                                            <div class="avatar">
                                                <div class="w-8 rounded">
                                                    <img src="{{ asset($variant->variant_image) }}"
                                                        alt="Tailwind-CSS-Avatar-component" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <p>{{ $variant->product->name }}</p>
                                            <p>Jumlah : <span>{{ $transaction['cart']['quantity'] }}</span></p>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td>{{ $transaction['user']['name'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction['summary']['created_at'])->format('d-m-Y H:i:s') }}
                            </td>
                            <td>Rp {{ number_format($transaction['summary']['payment']) }}</td>

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
