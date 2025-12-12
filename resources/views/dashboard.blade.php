<x-app-layout>
    <x-slot name="header">

        <h1 class="text-3xl font-bold text-gray-900">Dashboard Petugas 🧑‍⚕️</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan status kepatuhan dan aktivitas pasien per
            **{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}**.</p>
    </x-slot>

    <!-- Stat Cards (4 Metrik Utama) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- 1. Total Pasien (WARNA TEMA: Vibrant Blue) -->
        <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-300">
            <p class="text-base font-medium text-gray-500 mb-2 flex items-center">
                Total Pasien
                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" style="color: #3D94F8;">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd"></path>
                </svg>
            </p>
            <h2 class="text-4xl font-extrabold" style="color: #3D94F8;">{{ $summary['total_patients'] }}</h2>
            <p class="text-xs text-gray-500 mt-1">Pasien Aktif Terdaftar</p>
        </div>

        <!-- 2. Aktif Hari Ini -->
        <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-300">
            <p class="text-base font-medium text-gray-500 mb-2 flex items-center">
                Aktif Hari Ini
                <svg class="w-5 h-5 ml-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                </svg>
            </p>
            <h2 class="text-4xl font-extrabold text-yellow-700">{{ $summary['active_today'] }}</h2>
            <p class="text-xs text-gray-500 mt-1">Harus Minum Obat</p>
        </div>

        <!-- 3. Belum Minum Obat -->
        <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-300">
            <p class="text-base font-medium text-gray-500 mb-2 flex items-center">
                Belum Konfirmasi
                <svg class="w-5 h-5 ml-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"></path>
                </svg>
            </p>
            <h2 class="text-4xl font-extrabold text-red-700">{{ $summary['not_taken_today'] }}</h2>
            <p class="text-xs text-gray-500 mt-1">Belum Ada Log Hari Ini</p>
        </div>

        <!-- 4. Selesai Minum Obat (WARNA TEMA: Mint Green) -->
        <div class="bg-white p-5 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-300">
            <p class="text-base font-medium text-gray-500 mb-2 flex items-center">
                Selesai Pengobatan
                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" style="color: #3CC39F;">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
            </p>
            <h2 class="text-4xl font-extrabold" style="color: #3CC39F;">{{ $summary['finished_treatment'] }}</h2>
            <p class="text-xs text-gray-500 mt-1">Pasien Sudah Tahap Akhir</p>
        </div>
    </div>

    <!-- Area Chart Kepatuhan 30 Hari -->
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 mb-8">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Tren Kepatuhan Pasien (30 Hari Terakhir)</h3>
        <p class="text-sm text-gray-500 mb-4">Perbandingan jumlah pasien yang konfirmasi minum obat vs. yang tidak
            konfirmasi per hari.</p>

        <div class="relative w-full h-80">
            <canvas id="complianceChart"></canvas>
        </div>

    </div>
    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari Controller
            const complianceData = {!! json_encode($complianceChart) !!};

            // Setup Data untuk Stacked Bar Chart
            const data = {
                labels: complianceData.labels,
                datasets: [{
                        label: 'Minum Obat (Konfirmasi Berhasil)',
                        data: complianceData.confirmed,
                        // 💡 WARNA TEMA: Mint Green untuk Konfirmasi Berhasil
                        backgroundColor: '#3CC39F',
                        borderRadius: 4,
                        barPercentage: 0.8,
                        categoryPercentage: 0.8,
                    },
                    {
                        label: 'Tidak Minum Obat (Belum Konfirmasi)',
                        data: complianceData.not_confirmed,
                        backgroundColor: '#EF4444', // Tetap Merah untuk risiko tinggi
                        borderRadius: 4,
                        barPercentage: 0.8,
                        categoryPercentage: 0.8,
                    }
                ]
            };

            // Konfigurasi Chart (Sama seperti sebelumnya)
            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Pasien'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    }
                }
            };

            // Render Chart
            const ctx = document.getElementById('complianceChart').getContext('2d');
            new Chart(ctx, config);
        });
    </script>

</x-app-layout>
