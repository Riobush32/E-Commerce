<x-layouts-main>
    <x-flash-message></x-flash-message>
    @foreach ($transactions as $order_number => $orders)
        <div class="overflow-x-auto mt-3">
            <h3 class="text-primary">Order Number: {{ $order_number }} </h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0;
                        $shippingCost = 0;
                        $discount = 0;
                    @endphp
                    @foreach ($orders as $transaction)
                        <tr>
                            <th>{{ $transaction->cart->variant->product->name }}</th>
                            <td>{{ $transaction->cart->quantity }}</td>
                            <td>
                                Rp {{ number_format($transaction->cart->variant->product->price,2,',','.')  }}
                            </td>
                            <td>Rp {{ number_format($transaction->cart->variant->product->price * $transaction->cart->quantity, 2, ',', '.') }}</td>
                            {{-- <td>{{ $transaction->summary->shipping_cost}}</td> --}}
                        </tr>
                    @php
                        $shippingCost = $transaction->summary->shipping_cost;
                        $discount = $transaction->summary->discount;
                        $totalPrice += (($transaction->cart->variant->product->price * $transaction->cart->quantity)+$shippingCost - $discount);
                    @endphp
                    @endforeach
                    <tr class="">
                        <td>Shipping Cost</td>
                        <td>Rp {{ number_format($shippingCost, 2, ',', '.') }}</td>
                    </tr>
                    <tr class="">
                        <td>Discount</td>
                        <td>Rp {{ number_format($discount, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="">Total Price</td>
                        <td>Rp {{ number_format($totalPrice, 2, ',', '.') }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    @endforeach

</x-layouts-main>
