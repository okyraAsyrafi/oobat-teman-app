<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detail Hasil Kuisioner</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">

                <!-- Header -->
                <div class="p-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Pasien: {{ $result->patient->name }}</h3>
                    <p class="text-sm text-gray-600">
                        Tanggal: {{ $result->date_answer->format('d-m-Y H:i') }} |
                        Skor Rata-rata: {{ number_format($result->score_avg, 0) }}%
                    </p>
                </div>

                <!-- Efek Samping & Keluhan -->
                <div class="p-4 border-b">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Efek Samping</h4>
                            <p class="text-gray-700">{{ $result->side_effect ?: 'Tidak ada' }}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900 mb-2">Keluhan</h4>
                            <p class="text-gray-700">{{ $result->complaints ?: 'Tidak ada' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Jawaban -->
                <div class="p-4">
                    <h4 class="font-medium text-gray-900 mb-4">Jawaban Pertanyaan</h4>
                    <div class="space-y-4">
                        @foreach ($result->details as $detail)
                            <div class="p-4 border rounded-lg">
                                <div class="mb-2">
                                    <strong>{{ $loop->iteration }}.</strong> {{ $detail->question->question }}
                                </div>
                                <div class="ml-6">
                                    <span class="text-gray-700">Jawaban:</span>
                                    <span class="ml-2 font-medium">{{ $detail->option->option_text }}</span>
                                    <span class="ml-2 text-sm text-gray-500">(Bobot:
                                        {{ $detail->option->weight }})</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <div class="p-4 border-t">
                    <a href="{{ route('question_answer.index') }}"
                        class="inline-flex items-center text-gray-700 hover:text-gray-900">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
