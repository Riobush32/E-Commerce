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
                                class="step {{ $transaction->status == '1' ||
                                $transaction->status == '2' ||
                                $transaction->status == '3' ||
                                $transaction->status == '4' ||
                                $transaction->status == '5'
                                    ? 'step-primary'
                                    : '' }}">
                                Pesanan Diproses
                            </li>
                            <li
                                class="step {{ $transaction->status == '2' ||
                                $transaction->status == '3' ||
                                $transaction->status == '4' ||
                                $transaction->status == '5'
                                    ? 'step-primary'
                                    : '' }}">
                                Pesanan DiPacking
                            </li>
                            <li
                                class="step {{ $transaction->status == '3' || $transaction->status == '4' || $transaction->status == '5'
                                    ? 'step-primary'
                                    : '' }}">
                                Pesanan Dikirim
                            </li>
                            <li
                                class="step {{ $transaction->status == '4' || $transaction->status == '5' ? 'step-primary' : '' }}">
                                Pesanan Diterima</li>
                            <li class="step {{ $transaction->status == '5' ? 'step-primary' : '' }}">Pesanan Selesai</li>
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
                                        <img src="{{ asset($transaction->cart->variant->variant_image) }}"
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
                    @if ($transaction->status == '4')
                        <td colspan="3" rowspan="5" class="text-center">
                            <div class="flex gap-2 items-center justify-center">
                                <a href="{{ route('transactionUpdateStatus', ['order_number' => $order_number]) }}"
                                    class="btn btn-success">Selesaikan Pesanan</a>
                            </div>
                        </td>
                    @elseif($transaction->status == '5')
                        <td colspan="3" rowspan="5" class="">

                            <div class="flex gap-4 m-2">
                                @foreach ($orders as $transaction)
                                    @php
                                        $coment = \App\Models\Coment::where('user_id', Auth::user()->id)
                                            ->where('product_id', $transaction->cart->variant->product->id)
                                            ->first();
                                            // dd($coment);
                                    @endphp
                                    @if ($coment == null)
                                        <div class="card bg-base-100 w-[400px] shadow-xl">
                                            <form
                                                action="{{ route('transactionComent', ['id' => $transaction->cart->variant->product->id, 'transaction' => $transaction->id] ) }}"
                                                method="post" class="card-body">
                                                @csrf
                                                <div class="flex gap-3">
                                                    <div class="">
                                                        <h2 class="text-md">Beri Ulasan Anda! tentang </h2>
                                                        <h2 class="text-md text-sky-800">
                                                            {{ $transaction->cart->variant->product->name }}</h2>
                                                        <div class="rating rating-sm">
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="1" />
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                checked="checked" value="2" />
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="3" />
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="4" />
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="5" />
                                                        </div>
                                                    </div>

                                                    <div class="">
                                                        <textarea required name="ulasan" class="textarea textarea-bordered" placeholder="tulis ulasan kamu disini"></textarea>
                                                    </div>

                                                </div>

                                                <button type="submit" class="btn btn-primary btn-sm">Kirim
                                                    Ulasan</button>
                                            </form>
                                        </div>
                                    @elseif($coment != null)
                                        <div class="card bg-base-100 w-[400px] shadow-xl">
                                            <div class="card-body">
                                                <div class="flex gap-3">
                                                    <div class="">
                                                        <h2 class="text-md">Ulasan Anda tentang </h2>
                                                        <h2 class="text-md text-sky-800">
                                                            {{ $transaction->cart->variant->product->name }}</h2>
                                                        <div class="rating rating-sm">
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="1" {{ $coment->rating == 1 ? 'checked' : '' }} disabled/>
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400" {{ $coment->rating == 2 ? 'checked' : '' }} value="2" disabled/>
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="3"  {{ $coment->rating == 3 ? 'checked' : '' }} disabled/>
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="4" {{ $coment->rating == 4 ? 'checked' : '' }} disabled/>
                                                            <input type="radio" name="rating"
                                                                class="mask mask-star-2 bg-orange-400"
                                                                value="5"  {{ $coment->rating == 5 ? 'checked' : '' }} disabled/>
                                                        </div>
                                                    </div>

                                                    <div class="">
                                                        <textarea readonly name="ulasan" class="textarea textarea-bordered" >{{ $coment->coment }}</textarea>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach


                            </div>
                        </td>
                    @endif

                    </td>
                </tr>
                <tr class="">
                    <td>Shipping Cost</td>
                    <td>Rp {{ number_format($shippingCost, 2, ',', '.') }}</td>

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
