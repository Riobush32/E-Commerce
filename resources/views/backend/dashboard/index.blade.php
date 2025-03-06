<x-layouts-backend>
    <x-slot:active>{{ $active }}</x-slot:active>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <div class="w-full flex gap-4 p-3">
        <div class="w-96 p-5 rounded-xl bg-white">
            <h1 class="mb-3">Status Transaksi</h1>
            <canvas id="myPieChart" width="200" height="200"></canvas>
        </div>
        <div class="">


            <div class="flex flex-wrap gap-4 h-auto">
                <div class="">
                    <div class="stats shadow">
                        <div class="stat">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <i class="text-3xl text-sky-500 fa-solid fa-users"></i>
                                </div>
                                <div class="">
                                    <div class="stat-title">Total Users</div>
                                    <div class="stat-value">{{ $jumlahUsers }}</div>
                                    {{-- <div class="stat-desc">21% more than last month</div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="stats shadow">
                        <div class="stat">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <i class="text-3xl text-primary fa-solid fa-shirt"></i>
                                </div>
                                <div class="">
                                    <div class="stat-title">Total Product</div>
                                    <div class="stat-value">{{ $totalProduct }}</div>
                                    {{-- <div class="stat-desc">21% more than last month</div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="stats shadow">
                        <div class="stat">
                            <div class="flex items-center gap-4">
                                <div class="">
                                    <i class="text-3xl text-amber-800 fa-solid fa-box"></i>
                                </div>
                                <div class="">
                                    <div class="stat-title">Total Order</div>
                                    <div class="stat-value">{{ $totalOrder }}</div>
                                    {{-- <div class="stat-desc">21% more than last month</div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-5">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-5">


    </div>
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labelsTransaksi),
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: @json($valuesTransaksi),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        const label = @json($StatusTransaksi);
        const data = @json($jumlahTransaksi);

        // Fungsi untuk menghasilkan warna hex acak
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Array untuk menyimpan warna acak
        const Colors = [];

        // Iterasi berdasarkan kategori dan menambahkan warna acak
        label.forEach(() => {
            Colors.push(getRandomColor());
        });

        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie', // Jenis chart: 'pie'
            data: {
                labels: label, // Label untuk setiap bagian
                datasets: [{
                    label: 'My Pie Chart', // Label dataset
                    data: data, // Data untuk setiap bagian pie
                    backgroundColor: Colors, // Warna untuk setiap bagian
                    borderColor: ['#FFFFFF', '#FFFFFF', '#FFFFFF'], // Warna border
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Responsif untuk berbagai ukuran layar
                plugins: {
                    legend: {
                        position: 'top', // Posisi legend
                    },
                    tooltip: {
                        enabled: true // Menampilkan tooltip saat hover
                    }
                }
            }
        });
    </script>



</x-layouts-backend>
