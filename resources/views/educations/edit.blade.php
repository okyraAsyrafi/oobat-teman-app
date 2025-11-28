<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Artikel: {{ $education->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('educations.update', $education) }}" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Judul Artikel</label>
                        <input type="text" name="title" id="title"
                            value="{{ old('title', $education->title) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Gambar -->
                    <div class="mb-4">
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Ganti Gambar
                            (Opsional)</label>
                        <input type="file" name="image" id="image"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            accept="image/*">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Gambar Lama -->
                        @if ($education->image_path)
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
                                <img src="{{ Storage::url($education->image_path) }}" alt="Gambar lama"
                                    class="h-32 w-auto object-contain border rounded">
                            </div>
                        @endif

                        <!-- Preview Gambar Baru -->
                        <div id="image-preview" class="mt-2 hidden">
                            <p class="text-sm text-gray-600 mb-1">Pratinjau gambar baru:</p>
                            <img id="preview-image" src="#" alt="Preview gambar"
                                class="h-32 w-auto object-contain border rounded">
                        </div>
                    </div>

                    <!-- Konten (CKEditor) -->
                    <div class="mb-4">
                        <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Konten
                            Artikel</label>
                        <textarea name="content" id="editor" rows="8">{{ old('content', $education->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('educations.index') }}"
                            class="inline-flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Perbarui Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-image');

            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(e.target.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        });

        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
