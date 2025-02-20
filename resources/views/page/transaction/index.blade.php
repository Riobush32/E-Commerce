<x-layouts-main>
    <x-flash-message></x-flash-message>
    @foreach ($transactions as $order_number => $orders)
        <div class="overflow-x-auto mt-3">
            <h3 class="text-primary">Order Number: {{ $order_number }}</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Variant</th>
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
                    <ul class="steps my-3 text-xs">
                        @foreach ($orders as $transaction)
                        <li class="step step-primary">Check Out</li>
                        <li
                            class="step {{ $transaction->status == 'approved' ||
                                $transaction->status == 'packing' ||
                                $transaction->status == 'shipment' ||
                                $transaction->status == 'arrived' ||
                                $transaction->status == 'Accepted' ? 'step-primary' : '' }}">
                               Has Been Paid
                        </li>
                        <li class="step {{ $transaction->status == 'packing' ||
                            $transaction->status == 'shipment' ||
                            $transaction->status == 'arrived' ||
                            $transaction->status == 'Accepted' ? 'step-primary' : '' }}">
                            Packing
                        </li>
                        <li class="step {{ $transaction->status == 'shipment'
                            || $transaction->status == 'arrived'
                            || $transaction->status == 'Accepted' ? 'step-primary' : '' }}" >
                            Shipment in progress
                        </li>
                        <li class="step {{ $transaction->status == 'arrived' ||
                            $transaction->status == 'Accepted' ? 'step-primary' : '' }}" >Shipment delivered</li>
                        <li class="step {{ $transaction->status == 'Accepted' ? 'step-primary' : '' }}" >Accepted</li>
                        @break
                        @endforeach
                      </ul>
                    @foreach ($orders as $transaction)

                        <tr>
                            <th>
                                <a class="flex gap-2 items-center"
                                    href="{{ route('productDetails', ['id' => $transaction->cart->variant->product->id]) }}">
                                    <div class="avatar">
                                        <div class="w-12 rounded">
                                          <img
                                            src="{{ asset($transaction->cart->variant->variant_image) }}"
                                            alt="Tailwind-CSS-Avatar-component" />
                                        </div>
                                      </div>
                                      <div class="">{{ $transaction->cart->variant->product->name }}</div>
                                </a>
                            </th>
                            <td>{{ $transaction->cart->variant->name }}</td>
                            <td>{{ $transaction->cart->quantity }}</td>
                            <td>
                                Rp {{ number_format($transaction->cart->variant->product->price, 2, ',', '.') }}
                            </td>
                            <td>Rp
                                {{ number_format($transaction->cart->variant->product->price * $transaction->cart->quantity, 2, ',', '.') }}
                            </td>
                            {{-- <td>{{ $transaction->summary->shipping_cost}}</td> --}}
                        </tr>
                        @php
                            $shippingCost = $transaction->summary->shipping_cost;
                            $discount = $transaction->summary->discount;
                            $weight = $transaction->summary->weight;
                            $estimation = $transaction->summary->estimations;
                            $totalPrice +=
                                $transaction->cart->variant->product->price * $transaction->cart->quantity +
                                $shippingCost -
                                $discount;
                        @endphp
                    @endforeach
                    <tr class="">
                        <td>Weight</td>
                        <td>{{ number_format($weight * 1000, 2, ',', '.') }} Kg</td>
                    </tr>
                    <tr class="">
                        <td>Shipping Cost</td>
                        <td>Rp {{  number_format($shippingCost, 2, ',', '.') }}</td>
                    </tr>
                    <tr class="">
                        <td>Estimation</td>
                        <td>{{ $estimation }} Days</td>
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
