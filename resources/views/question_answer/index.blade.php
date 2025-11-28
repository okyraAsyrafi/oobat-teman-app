<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Hasil Kuisioner Pasien</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-6">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">

                <!-- Header & Search -->
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b">
                    <div class="w-full md:w-1/2">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Hasil Kuisioner</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Monitor kesehatan dan kepatuhan pengobatan pasien.
                        </p>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-3">
                        <form class="flex items-center">
                            <label for="search" class="sr-only">Cari</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2"
                                    placeholder="Cari nama pasien...">
                            </div>
                        </form>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mx-4 mb-4 px-4 py-3 bg-green-100 text-green-800 text-sm rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabel Hasil Kuisioner -->
                <div class="overflow-x-auto px-4 py-4">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Nama Pasien</th>
                                <th scope="col" class="px-4 py-3">Tanggal</th>
                                <th scope="col" class="px-4 py-3">Kepatuhan</th>
                                <th scope="col" class="px-4 py-3">Efek Samping</th>
                                <th scope="col" class="px-4 py-3">Keluhan</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($results as $result)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $result->patient->name }}</td>
                                    <td class="px-4 py-3">{{ $result->date_answer->format('Y-m-d') }}</td>
                                    <td class="px-4 py-3">{{ number_format($result->score_avg, 0) }}%</td>
                                    <td class="px-4 py-3">{{ $result->side_effect ?: 'Tidak ada' }}</td>
                                    <td class="px-4 py-3">{{ $result->complaints ?: 'Tidak ada' }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusClass =
                                                $result->score_avg >= 80
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-yellow-100 text-yellow-800';
                                            $statusText = $result->score_avg >= 80 ? 'Baik' : 'Perlu Perhatian';
                                        @endphp
                                        <span
                                            class="{{ $statusClass }} text-xs px-2 py-1 rounded">{{ $statusText }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('question_answer.show', $result) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 p-1 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200"
                                            title="Lihat detail kuisioner">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">Tidak ada hasil
                                        kuisioner.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($results->hasPages())
                    <div class="p-4">{{ $results->links() }}</div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
