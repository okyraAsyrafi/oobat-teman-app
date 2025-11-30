<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Kuisioner</h1>
    </x-slot>

    <div class="py-6">
        @if (session('success') && request()->routeIs('questionnaire.*'))
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden  mb-6">
                <div class="p-4 border-b">
                    <div class="px-4 py-3 bg-green-100 text-green-800 text-sm rounded-lg">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">
            <!-- =============== TABEL 1: PERTANYAAN =============== -->
            <div class="p-4 border-b">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Pertanyaan</h3>
                        <p class="text-sm text-gray-600">Kelola pertanyaan kuisioner pasien TB.</p>
                    </div>
                    <a href="{{ route('questionnaire.questions.create') }}"
                        class="flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Pertanyaan
                    </a>
                </div>



                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">Pertanyaan</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($questions as $q)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ Str::limit($q->question, 80) }}</td>
                                    <td class="px-4 py-3">
                                        @if ($q->is_active)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Aktif</span>
                                        @else
                                            <span
                                                class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('questionnaire.questions.edit', $q) }}" title="Edit"
                                                class="inline-flex items-center justify-center w-8 h-8 p-1 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('questionnaire.questions.destroy', $q) }}"
                                                method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" title="Hapus"
                                                    class="inline-flex items-center justify-center w-8 h-8 p-1 text-red-600 bg-red-100 rounded-lg hover:bg-red-200"
                                                    onclick="return confirm('Yakin hapus pertanyaan ini?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-6 text-center text-gray-500">Tidak ada
                                        pertanyaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($questions->hasPages())
                    <div class="p-4">{{ $questions->links() }}</div>
                @endif
            </div>
        </div>
        <div class="bg-white shadow-md sm:rounded-lg overflow-hidden mt-8">
            <!-- =============== TABEL 2: OPSI JAWABAN =============== -->
            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Opsi Jawaban</h3>
                        <p class="text-sm text-gray-600">Opsi ini berlaku global untuk semua pertanyaan.</p>
                    </div>
                    <a href="{{ route('questionnaire.options.create') }}"
                        class="flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Opsi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-3">Opsi</th>
                                <th class="px-4 py-3">Bobot</th>
                                <th class="px-4 py-3">Urutan</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($options as $opt)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium">{{ $opt->option_text }}</td>
                                    <td class="px-4 py-3">{{ $opt->weight }}</td>
                                    <td class="px-4 py-3">{{ $opt->sort_order }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('questionnaire.options.edit', $opt) }}" title="Edit"
                                                class="inline-flex items-center justify-center w-8 h-8 p-1 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('questionnaire.options.destroy', $opt) }}"
                                                method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" title="Hapus"
                                                    class="inline-flex items-center justify-center w-8 h-8 p-1 text-red-600 bg-red-100 rounded-lg hover:bg-red-200"
                                                    onclick="return confirm('Yakin hapus opsi ini?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">Tidak ada opsi
                                        jawaban.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($options->hasPages())
                    <div class="p-4">{{ $options->links() }}</div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
