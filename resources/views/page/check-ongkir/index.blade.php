<x-layouts-main>
    {{-- <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-6 text-center text-orange-600">Cek Ongkir</h1>

        <!-- Provinsi Asal -->
        <div class="form-control mb-4">
            <label for="KotaAsal" class="label">
                <span class="label-text text-gray-700">Kota Asal:</span>
            </label>
            <select id="KotaAsal" name="origin"
                class="select select-bordered border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="" disabled selected>Pilih Kota Asal</option>
                @foreach ($cities as $city)
                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                @endforeach
            </select>
        </div>
        <!-- Provinsi Asal -->
        <div class="form-control mb-4">
            <label for="KotaTujuan" class="label">
                <span class="label-text text-gray-700">Kota Asal:</span>
            </label>
            <select id="KotaTujuan" name="destination"
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
            <label class="input input-bordered flex items-center gap-2 border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <input type="number" step="0.01" class="grow" placeholder="300 gr" name="weight" />
                <span class="badge badge-primary">gram</span>
            </label>
        </div>
        <div class="form-control mb-4">
            <label for="Kurir" class="label">
                <span class="label-text text-gray-700">Pilih Kurir</span>
            </label>
            <select id="Kurir"
                class="select select-bordered border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="" disabled selected>Pilih kurir</option>
                <option value="">JNT</option>
                <option value="">JNE</option>

            </select>
        </div>


    </div> --}}

    @livewire('checkongkir', ['cart_id' => $cart_id])
</x-layouts-main>
