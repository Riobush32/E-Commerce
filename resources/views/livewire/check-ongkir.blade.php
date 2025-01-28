<div class="flex justify-center items-center gap-4">
    <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto mt-10">
        <form action="">
            <h1 class="text-2xl font-bold mb-6 text-center text-orange-600">Cek Ongkir</h1>

            <!-- Provinsi Asal -->
            {{-- <div class="form-control mb-4">
                <label for="KotaAsal" class="label">
                    <span class="label-text text-gray-700">Kota Asal:</span>
                </label>
                <select id="KotaAsal" name="origin" wire:model="origin"
                    class="select select-bordered border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="" disabled selected>Pilih Kota Asal</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                    @endforeach
                </select>
            </div> --}}
            <!-- Provinsi Asal -->
            <div class="form-control mb-4">
                <label for="KotaTujuan" class="label">
                    <span class="label-text text-gray-700">Kota Asal:</span>
                </label>
                <select id="KotaTujuan" name="destination" wire:model="destination"
                    class="select select-bordered border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="" disabled selected>Pilih Kota Tujuan</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control mb-4">
                <label for="Berat" class="label">
                    <span class="label-text text-gray-700">Berat</span>
                </label>
                <label
                    class="input input-bordered flex items-center gap-2 border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <input type="number" step="0.01" class="grow" placeholder="300 gr" name="weight"
                        wire:model="weight" />
                    <span class="badge badge-primary">gram</span>
                </label>
            </div>
            <div class="form-control mb-4">
                <label for="Kurir" class="label">
                    <span class="label-text text-gray-700">Pilih Kurir</span>
                </label>
                <select id="Kurir" wire:model="courier" wire:change="updateWeight"
                    class="select select-bordered border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <option value="" disabled selected>Pilih kurir</option>
                    <option value="pos">POS</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                </select>
            </div>
            <div class="form-control mb-4">
                <label for="Berat" class="label">
                    <span class="label-text text-gray-700">address</span>
                </label>
                <label
                    class="input input-bordered flex items-center gap-2 border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    <input type="number" step="0.01" class="grow" placeholder="300 gr" name="weight"
                        wire:model="address" />
                    <span class="badge badge-primary">gram</span>
                </label>
            </div>

        </form>



    </div>

    @if ($ongkir != [])
        <div>
            <h1 class="text-xl font-bold mb-4">Pilih Layanan Pengiriman</h1>
            @foreach ($ongkir as $item)
                <div class="mb-4">
                    <h2 class="font-bold text-lg">{{ $item['name'] }}</h2>
                    @foreach ($item['costs'] as $itemCost)
                        <div class="border p-4 rounded-md mb-2">
                            <h3 class="font-semibold">Service: {{ $itemCost['service'] }}</h3>
                            <p>Description: {{ $itemCost['description'] }}</p>
                            @foreach ($itemCost['cost'] as $cost)
                                <div class="p-2 border-t mt-2">
                                    <p>Harga: Rp {{ number_format($cost['value'], 0, ',', '.') }}</p>
                                    <p>Estimasi: {{ $cost['etd'] }}</p>
                                    <p>Keterangan: {{ $cost['note'] }}</p>

                                    <!-- Pilih Layanan -->
                                    <button
                                        wire:click="selectService('{{ $item['code'] }}', '{{ $itemCost['service'] }}', {{ $cost['value'] }}, '{{ $cost['etd'] }}')"
                                        class="btn btn-primary mt-2">
                                        Pilih
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

    @endif
</div>
