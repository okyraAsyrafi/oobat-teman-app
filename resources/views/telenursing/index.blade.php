<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900">Pengaturan Telenursing</h1>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-lg shadow p-6">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- SATU FORM GLOBAL -->
            <form method="POST" action="{{ route('telenursing.update') }}" novalidate>
                @csrf

                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kelola Nomor WhatsApp Petugas</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        @foreach ($contacts as $index => $contact)
                            @php
                                $i = $index + 1;
                            @endphp
                            <div class="p-4 border rounded-lg">
                                <h4 class="font-medium text-gray-900 mb-3">Petugas {{ $i }}</h4>

                                <div class="mb-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
                                    <input type="text" name="name_{{ $i }}"
                                        value="{{ old("name_$i", $contact->name) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        readonly value="Petugas {{ $i }}">
                                </div>

                                <div class="mb-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Nomor
                                        WhatsApp</label>
                                    <input type="text" name="phone_{{ $i }}"
                                        value="{{ old("phone_$i", $contact->phone) }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="081234567890" required>
                                    @error("phone_$i")
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tombol Simpan Per Petugas -->
                                <button type="submit" name="submit_index" value="{{ $i }}"
                                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Simpan Petugas {{ $i }}
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-6">
                        <div class="p-4 border rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-3">Aturan</h4>
                            <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                                <li>Format: <strong>081234567890</strong></li>
                                <li>Tidak boleh mengandung huruf/spasi</li>
                                <li>Setiap nomor harus unik</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
