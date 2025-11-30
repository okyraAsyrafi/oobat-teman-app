<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900">Jadwal Obat</h1>
    </x-slot>

    <div class="py-6">
        <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">

            <!-- Header -->
            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b">
                <div class="w-full md:w-1/2">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Jadwal Obat</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Kelola jadwal pengingat minum obat pasien.
                    </p>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-3">
                    <a href="{{ route('medication.schedules.create') }}"
                        class="flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Buat Jadwal
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="mx-4 mb-4 px-4 py-3 bg-green-100 text-green-800 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Jadwal -->
            <div class="overflow-x-auto px-4 py-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Pasien</th>
                            <th scope="col" class="px-4 py-3">Waktu Alarm</th>
                            <th scope="col" class="px-4 py-3">Periode</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Catatan</th>
                            <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $schedule->patient->name }}</td>
                                <td class="px-4 py-3">{{ $schedule->time_of_day->format('H:i') }}</td>
                                <td class="px-4 py-3">
                                    {{ $schedule->start_date->format('Y-m-d') }}<br>
                                    s/d {{ $schedule->end_date->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs {{ $schedule->status_class }}">
                                        {{ $schedule->status_label }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ Str::limit($schedule->notes, 30) }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('medication.schedules.show', $schedule) }}"
                                            title="Lihat detail"
                                            class="inline-flex items-center justify-center w-8 h-8 p-1 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        @if ($schedule->isActive())
                                            <form action="{{ route('medication.schedules.cancel', $schedule) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <button type="submit" title="Batalkan jadwal"
                                                    onclick="return confirm('Yakin batalkan jadwal ini? Alasan harus diisi.')"
                                                    class="inline-flex items-center justify-center w-8 h-8 p-1 text-red-600 bg-red-100 rounded-lg hover:bg-red-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Tidak ada jadwal.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($schedules->hasPages())
                <div class="p-4">{{ $schedules->links() }}</div>
            @endif

        </div>
    </div>
</x-app-layout>
