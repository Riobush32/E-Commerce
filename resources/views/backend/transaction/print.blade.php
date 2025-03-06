<!doctype html>
<html data-theme="mytheme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    {{-- icon   --}}
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}">
    @livewireStyles
</head>

<body>
    <!-- Container Laporan -->
    <div class="max-w-6xl mx-auto p-8 bg-white shadow-xl rounded-lg mt-12">

        <!-- Header Laporan -->
        <div class="text-center mb-8 mt-10">
            <h1 class="text-4xl font-semibold text-gray-800">Laporan Penjualan</h1>
            <p class="text-lg text-gray-500">Periode: {{ $dari }} - {{ $sampai }}</p>
        </div>


        <!-- Tabel Penjualan -->
        <div class="w-full flex justify-center mt-10">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order Number</th>
                            <th>Detail Pesanan</th>
                            <th>Nama Customer</th>
                            <th>Tanggal Order</th>
                            <td>Total Harge</td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @php
                            $totalHarga = 0;
                            $no = 1;
                        @endphp
                        @foreach ($orders as $orderNumber => $transactionsByOrder)
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $orderNumber }}</td>
                                <td>
                                    @foreach ($transactionsByOrder as $transaction)
                                        @php
                                            $variantId = $transaction['cart']['variant_id'];
                                            $variant = \App\Models\Variant::find($variantId);
                                        @endphp
                                        <p>
                                            <span>{{ $variant->product->name }}-</span>
                                            <span>{{ $transaction['cart']['quantity'] }}</span>
                                        </p>
                                    @endforeach
                                </td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>Rp {{ number_format($transaction->summary->payment) }}</td>
                            </tr>
                            @php
                                $totalHarga += $transaction->summary->payment;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>


        <!-- Total Penjualan -->
        <div class="mt-8 flex justify-end items-center">
            <p class="text-lg font-semibold text-gray-800">Total Penjualan: <span
                    class="text-xl font-bold text-indigo-600">Rp {{ number_format($totalHarga) }}</span></p>
        </div>

    </div>

</body>
<script>
    window.print();
</script>

</html>
