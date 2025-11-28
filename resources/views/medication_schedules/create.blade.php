<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Buat Jadwal Minum Obat</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('medication.schedules.store') }}">
                    @csrf

                    <!-- Pasien -->
                    <div class="mb-4">
                        <label for="patient_id" class="block mb-2 text-sm font-medium text-gray-900">Pasien</label>
                        <select name="patient_id" id="patient_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            <option value="">-- Pilih Pasien --</option>
                            @foreach ($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->nik }})</option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu Alarm -->
                    <div class="mb-4">
                        <label for="time_of_day" class="block mb-2 text-sm font-medium text-gray-900">Waktu
                            Alarm</label>
                        <input type="time" name="time_of_day" id="time_of_day"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        @error('time_of_day')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Durasi -->
                    <div class="mb-4">
                        <label for="duration_days" class="block mb-2 text-sm font-medium text-gray-900">Durasi
                            (hari)</label>
                        <input type="number" name="duration_days" id="duration_days"
                            value="{{ old('duration_days', 7) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            min="1" max="31" required>
                        @error('duration_days')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-4">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                            Mulai</label>
                        <input type="date" name="start_date" id="start_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="mb-4">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900">Catatan
                            (Opsional)</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('medication.schedules.index') }}"
                            class="inline-flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
