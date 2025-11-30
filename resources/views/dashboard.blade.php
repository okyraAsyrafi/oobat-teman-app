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

    <!-- Area Quick Tasks/Peringatan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Quick Tasks -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Aksi Cepat & Peringatan 🔔</h3>
            <div class="space-y-4">

                @if ($quickTasks['not_taken_today'] > 0)
                    <div class="p-4 bg-red-100 rounded-lg border border-red-200 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-red-800">Tindak Lanjut Segera (Hari Ini)</p>
                            <p class="text-sm text-red-600">Ada **{{ $summary['not_taken_today'] }} pasien** yang Belum
                                Konfirmasi Minum Obat hari ini.</p>
                        </div>
                        <a href="{{ route('medication.schedules.index') }}"
                            class="text-sm text-red-600 hover:text-red-800 font-medium">Lihat Detail →</a>
                    </div>
                @endif

                @if ($quickTasks['questionnaire_due'] > 0)
                    <div
                        class="p-4 bg-yellow-100 rounded-lg border border-yellow-200 flex justify-between items-center">
                        <div>
                            <p class="font-medium text-yellow-800">Kuesioner Wajib Belum Diisi</p>
                            <p class="text-sm text-yellow-600">Ada **{{ $quickTasks['questionnaire_due'] }} pasien**
                                yang belum mengisi kuesioner bulanan.</p>
                        </div>
                        <a href="{{ Route::has('question_answer.index') ? route('question_answer.index') : '#' }}"
                            class="text-sm text-yellow-600 hover:text-yellow-800 font-medium">Lihat Daftar →</a>
                    </div>
                @endif

                @if ($quickTasks['schedules_ending'] > 0)
                    <div class="p-4 rounded-lg border flex justify-between items-center"
                        style="background-color: #3D94F81A; border-color: #3D94F84D;">
                        <div>
                            <p class="font-medium" style="color: #3D94F8;">Jadwal Pengobatan Mendekati Akhir</p>
                            <p class="text-sm" style="color: #3D94F8CC;">Ada **{{ $quickTasks['schedules_ending'] }}
                                jadwal** yang akan berakhir dalam 7 hari ke depan.</p>
                        </div>
                        <a href="{{ route('medication.schedules.index') }}" class="text-sm font-medium"
                            style="color: #3D94F8;">Cek Jadwal →</a>
                    </div>
                @endif

                <!-- Jika tidak ada peringatan -->
                @if (empty($quickTasks['not_taken_today']) &&
                        empty($quickTasks['questionnaire_due']) &&
                        empty($quickTasks['schedules_ending']))
                    <div class="p-4 bg-green-100 text-green-800 text-sm rounded-lg text-center">
                        Semua dalam kondisi terkendali. Tidak ada peringatan mendesak.
                    </div>
                @endif

            </div>
        </div>

        <!-- Telenursing Contact -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Hubungi Telenursing 📞</h3>
            <p class="text-sm text-gray-500 mb-3">Gunakan kontak ini untuk koordinasi penjangkauan pasien.</p>
            <a href="{{ Route::has('telenursing.index') ? route('telenursing.index') : '#' }}"
                class="w-full inline-flex justify-center items-center py-2.5 px-5 text-sm font-medium text-white rounded-lg focus:ring-4 focus:outline-none"
                style="background-color: #3CC39F; hover-bg: #32A888; focus-ring: #3CC39F80;">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM11 15v2h6v-2h-6zM3 17h4v-2H3v2z">
                    </path>
                </svg>
                Kelola Kontak Telenursing
            </a>

            <div class="mt-4 border-t pt-4">
                <p class="text-xs text-gray-500 mb-2">Kontak Terpilih:</p>
                <div class="p-3 bg-gray-50 rounded-lg">
                    <p class="font-medium text-gray-900">Petugas Jaga: Suster Rina</p>
                    <p class="text-sm" style="color: #3CC39F;">WA: +62 812-XXXX-XXXX</p>
                </div>
            </div>
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
