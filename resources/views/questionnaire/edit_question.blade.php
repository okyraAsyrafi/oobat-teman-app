<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Pertanyaan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('questionnaire.questions.update', $question) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="question" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                        <textarea name="question" id="question" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>{{ old('question', $question->question) }}</textarea>
                        @error('question')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $question->is_active) ? 'checked' : '' }}
                                class="rounded text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('questionnaire.index') }}"
                            class="inline-flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Perbarui Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
