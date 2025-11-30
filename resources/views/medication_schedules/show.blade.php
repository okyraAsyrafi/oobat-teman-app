<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900">Detail Jadwal Obat</h1>
    </x-slot>

    <div class="py-6">
        <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">

            <!-- Header -->
            <div class="p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Pasien: {{ $schedule->patient->name }}</h3>
                <p class="text-sm text-gray-600">
                    Waktu Alarm: {{ $schedule->time_of_day->format('H:i') }} |
                    Periode: {{ $schedule->start_date->format('d-m-Y') }} s/d
                    {{ $schedule->end_date->format('d-m-Y') }}
                </p>
            </div>

            <!-- Info Jadwal -->
            <div class="p-4 border-b">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Catatan</h4>
                        <p class="text-gray-700">{{ $schedule->notes ?: 'Tidak ada catatan' }}</p>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Status</h4>
                        <span class="px-2 py-1 rounded text-xs {{ $schedule->status_class }}">
                            {{ $schedule->status_label }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Detail Konfirmasi -->
            <div class="p-4">
                <h4 class="font-medium text-gray-900 mb-4">Bukti Konfirmasi Minum Obat</h4>
                @if ($schedule->logs->isEmpty())
                    <p class="text-gray-500">Belum ada bukti konfirmasi.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($schedule->logs as $log)
                            <div class="p-4 border rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <div>
                                        <strong>{{ $log->log_date->format('Y-m-d') }} -
                                            {{ $log->log_date->format('H:i') }}</strong>
                                        <span class="ml-2 text-sm text-gray-500">({{ $log->patient->name }})</span>
                                    </div>
                                    <span class="px-2 py-1 rounded text-xs {{ $log->status_class }}">
                                        {{ $log->status_text }}
                                    </span>
                                </div>
                                @if ($log->is_taken)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($log->img_path) }}" alt="Bukti konfirmasi"
                                            class="h-20 w-auto object-cover rounded">
                                        <p class="mt-2 text-sm text-gray-700">
                                            {{ $log->notes ?: 'Tidak ada keterangan' }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Tombol Kembali -->
            <div class="p-4 border-t">
                <a href="{{ route('medication.schedules.index') }}"
                    class="inline-flex items-center text-gray-700 hover:text-gray-900">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
