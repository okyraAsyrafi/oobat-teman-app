<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900">
            Kelola User
        </h1>
    </x-slot>

    <div class="py-6">
        <!-- Card Utama -->
        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b">
                <div class="w-full md:w-1/2">
                    {{-- Opsional: Aktifkan nanti jika butuh search --}}
                    {{-- <form class="flex items-center">
                            <label for="search" class="sr-only">Cari</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2" placeholder="Cari user...">
                            </div>
                        </form> --}}

                    <h3 class="text-lg font-semibold text-gray-900">Daftar User</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Kelola user sistem Obat Teman. untuk mengatur akun user.
                    </p>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-3">
                    <a href="{{ route('admin.users.create') }}"
                        class="flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah User
                    </a>
                </div>
            </div>

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="mx-4 mb-4 px-4 py-3 bg-green-100 text-green-800 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Data -->
            <div class="overflow-x-auto px-4 py-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Username</th>
                            <th scope="col" class="px-4 py-3">Email</th>
                            <th scope="col" class="px-4 py-3">Role</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->username }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->getRoleNames()->first() ?? '–' }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            title="Edit user {{ $user->name }}"
                                            class="inline-flex items-center justify-center w-8 h-8 p-1 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200 focus:ring-2 focus:ring-blue-300 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>

                                        <!-- Tombol Hapus (hanya jika bukan diri sendiri) -->
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus user {{ $user->name }}"
                                                    onclick="return confirm('Yakin hapus user {{ addslashes($user->name) }}?')"
                                                    class="inline-flex items-center justify-center w-8 h-8 p-1 text-red-600 bg-red-100 rounded-lg hover:bg-red-200 focus:ring-2 focus:ring-red-300 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Tidak ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm text-gray-700">
                        Menampilkan
                        <span class="font-semibold">{{ $users->firstItem() }}</span>
                        sampai
                        <span class="font-semibold">{{ $users->lastItem() }}</span>
                        dari
                        <span class="font-semibold">{{ $users->total() }}</span>
                        data
                    </span>
                    {{ $users->links('vendor.pagination.flowbite') }}
                </nav>
            @endif

        </div>
    </div>

    {{-- Script Flowbite Dropdown (jika belum otomatis dari app.js) --}}
    @push('scripts')
        <script>
            // Jika Flowbite belum di-init global, aktifkan dropdown di sini
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Flowbite !== 'undefined') {
                    // Dropdown akan otomatis aktif jika pakai Flowbite JS
                }
            });
        </script>
    @endpush
</x-app-layout>
