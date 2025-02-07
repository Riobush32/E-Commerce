<x-layouts-main>
    <x-flash-message></x-flash-message>


    <div class="flex justify-center items-center min-h-screen bg-orange-50 py-5">
        <form action="{{ route('storeShippingAddress') }}" method="POST"
            class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
            @csrf
            <h1 class="text-3xl font-bold text-orange-600 text-center mb-6">Add Alamat</h1>
            <div class="divide-y divide-orange-300">
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Nama</span>
                    <span class="text-gray-600">
                        <input type="text" placeholder="your name" class="input input-bordered w-full max-w-xs"
                            name="nama" required />
                    </span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">No. Telepon</span>
                    <span class="text-gray-600">
                        <input name="no_hp" type="text" placeholder="your number"
                            class="input input-bordered w-full max-w-xs" required />
                    </span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Provinsi</span>
                    <select class="select select-bordered max-w-56" name="province" required>
                        <option disabled selected>pilih provinsi</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item['province_id'] }};{{ $item['province'] }}">{{ $item['province'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kabupaten/Kota</span>
                    <select class="select select-bordered max-w-56" name="city" required>
                        <option disabled selected>pilih Kabupaten / Kota</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city['city_id'] }};{{ $city['city_name'] }}">{{ $city['city_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kecamatan</span>
                    <span class="text-gray-600">
                        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                            name="kecamatan" required />
                    </span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kelurahan</span>
                    <span class="text-gray-600">
                        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                            name="kelurahan" required />
                    </span>
                </div>

                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kode Pos</span>
                    <span class="text-gray-600">
                        <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                            name="kode_pos" required />
                    </span>
                </div>
                <div class="py-3 flex items-start">
                    <span class="font-semibold text-gray-700 w-1/3">Alamat Lengkap</span>
                    <span class="text-gray-600 w-2/3 text-right">
                        <textarea class="textarea textarea-bordered" placeholder="Bio" name="address"></textarea>
                    </span>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <button type="submit" class="btn jus">save</button>
            </div>

        </form>
    </div>

</x-layouts-main>
