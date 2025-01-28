<x-layouts-main>
    <x-flash-message></x-flash-message>

    @if (empty($shippingAddress))
    <div class="w-full flex justify-end">
        <a href="{{ route('addShippingAddress') }}" class="btn btn-primary text-white font-light btn-sm">add</a>
    </div>
    @else
    <div class="flex justify-center items-center min-h-screen bg-orange-50">
        <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
            <h1 class="text-3xl font-bold text-orange-600 text-center mb-6">Detail Alamat</h1>
            <div class="divide-y divide-orange-300">
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Nama</span>
                    <span class="text-gray-600">{{ $shippingAddress->name }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">No. Telepon</span>
                    <span class="text-gray-600">{{ $shippingAddress->no_hp }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Provinsi</span>
                    <span class="text-gray-600">{{ $shippingAddress->province }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kabupaten/Kota</span>
                    <span class="text-gray-600">{{ $shippingAddress->city_name }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kecamatan</span>
                    <span class="text-gray-600">{{ $shippingAddress->kecamatan }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kelurahan</span>
                    <span class="text-gray-600">{{ $shippingAddress->kelurahan }}</span>
                </div>
                <div class="py-3 flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Kode Pos</span>
                    <span class="text-gray-600">{{ $shippingAddress->postal_code }}</span>
                </div>
                <div class="py-3 flex items-start">
                    <span class="font-semibold text-gray-700 w-1/3">Alamat Lengkap</span>
                    <span class="text-gray-600 w-2/3 text-right">
                        {{ $shippingAddress->address }}
                    </span>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <a href="{{ route('editShippingAddress',['id'=>$shippingAddress->id]) }}" class="btn btn-primary text-white font-light btn-sm">edit</a>
            </div>

        </div>
    </div>
    @endif



</x-layouts-main>
