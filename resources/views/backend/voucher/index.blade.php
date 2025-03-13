<x-layouts-backend>
    <x-slot:active>{{ $active }}</x-slot:active>
    <div x-data="{ formAddVoucher: false }" class="">
        @include('backend.components.breadcrumbs')
        @livewire('backend.voucher.voucher-list')

        <div x-show="formAddVoucher" class="fixed inset-0 flex items-center justify-center">
            @livewire('backend.voucher.add-voucher')
        </div>
        @livewire('backend.voucher.edit-voucher')

    </div>
    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ""); // Hapus semua karakter non-angka
            value = new Intl.NumberFormat("id-ID", {
                style: "decimal"
            }).format(value);
            input.value = "Rp " + value;
        }
    </script>
    <script>
        function formatPercentage(input) {
            setTimeout(() => {
                let value = input.value.replace(/\D/g, ""); // Hapus semua karakter non-angka

                // Konversi ke angka integer
                let numericValue = parseInt(value, 10);

                // Pastikan angka dalam rentang 1 - 100
                if (isNaN(numericValue) || numericValue < 1) {
                    numericValue = 1; // Jika kurang dari 1, set ke 1
                } else if (numericValue > 100) {
                    numericValue = 100; // Jika lebih dari 100, set ke 100
                }

                // Tambahkan simbol %
                input.value = numericValue + "%";
            }, 1); // Eksekusi setelah input diperbarui
        }
    </script>



</x-layouts-backend>
