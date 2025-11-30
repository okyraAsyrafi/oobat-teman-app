<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900">
            Edit Role: {{ $role->name }}
            </h2>
    </x-slot>

    <div class="py-6">
        <div class="bg-white rounded-lg shadow p-6">

            <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                @csrf
                @method('PUT')

                <!-- Nama Role -->
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                        Nama Role
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Contoh: dokter, koordinator" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan Khusus -->
                @if ($role->name === 'superadmin')
                    <div class="mb-4 p-3 bg-yellow-50 text-yellow-800 text-sm rounded-lg">
                        <strong>Role ini tidak bisa diubah.</strong>
                        Role <code>superadmin</code> dilindungi sistem.
                    </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('admin.roles.index') }}"
                        class="text-gray-700 inline-flex items-center hover:text-gray-900 border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>

                    @if ($role->name !== 'superadmin')
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Perbarui Role
                        </button>
                    @endif
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
