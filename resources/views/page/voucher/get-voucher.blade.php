<x-layouts-main>
    <div class="min-h-[80vh] ">
        <div class="grid grid-cols-3 gap-2 mx-auto">
            @foreach ($vouchers as $voucher)
                <form action="{{ route('buyVoucher', ['id' => $voucher->id]) }}" method="post" class="card w-96 bg-base-100 shadow-sm">
                  @csrf
                    <div class="card-body">
                        {{-- <span class="badge badge-xs badge-warning">Most Popular</span> --}}
                        <div class="flex justify-between">
                            <h2 class="text-3xl font-bold">{{ $voucher->name }}</h2>
                            <span class="text-xl">{{ $voucher->points_required }} <i
                                    class="fa-solid fa-coins text-yellow-400"></i></span>
                        </div>
                        <ul class="mt-6 flex flex-col gap-2 text-xs">
                            <li class="text-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 me-2 inline-block text-success"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Discount 
                                    @if ($voucher->discount_type == 'percentage')
                                        <span class="text-yellow-400">{{ $voucher->discount_value }} %</span>
                                    @elseif($voucher->discount_type == 'fixed')
                                        <span class="text-sky-400">Rp
                                            {{ number_format($voucher->discount_value) }}</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 me-2 inline-block text-success"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Berlaku Dari</span>
                                <span class="text-green-600"> {{ $voucher->valid_from }} </span>
                                <span> sampai</span>
                                <span  class="text-rose-600"> {{ $voucher->valid_until }}</span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 me-2 inline-block text-success"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Batch processing capabilities</span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 me-2 inline-block text-success"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Minimal Belanja </span>
                                <span class="text-fuchsia-500"> Rp{{ number_format($voucher->min_purchase) }}</span>
                            </li>
                        </ul>
                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary btn-block">Tukar Dengan {{ $voucher->points_required }} <i
                                    class="fa-solid fa-coins text-yellow-400"></i></button>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</x-layouts-main>
