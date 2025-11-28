<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Pasien: {{ $patient->name }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('patient.update', $patient) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $patient->name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div class="mb-4">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK (16
                            digit)</label>
                        <input type="text" name="nik" id="nik" value="{{ old('nik', $patient->nik) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="3271012345678901" required>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-4">
                        <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                            Lahir</label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                            value="{{ old('date_of_birth', $patient->date_of_birth->format('Y-m-d')) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- HP & Alamat -->
                    <div class="mb-4">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">No. HP
                            (Opsional)</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $patient->phone) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat
                            (Opsional)</label>
                        <textarea name="address" id="address" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ old('address', $patient->address) }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('patient.index') }}"
                            class="inline-flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Perbarui Pasien
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
