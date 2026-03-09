@extends('layouts.admin')
@section('title', 'Tambah Calon Admin')

@section('content')

    <div class="max-w-2xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Calon Admin</h1>
            <a href="{{ route('camin.index') }}"
               class="text-sm text-gray-500 hover:underline dark:text-gray-400">
                &larr; Kembali
            </a>
        </div>

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="mb-6 px-4 py-3 rounded-lg bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('camin.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @else border-gray-300 @enderror">
            </div>

            {{-- No Urut --}}
            <div>
                <label for="no_urut" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nomor Urut <span class="text-red-500">*</span>
                </label>
                <input type="number" id="no_urut" name="no_urut" value="{{ old('no_urut') }}" min="1" required
                       class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_urut') border-red-500 @else border-gray-300 @enderror">
            </div>

            {{-- Visi --}}
            <div>
                <label for="visi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Visi <span class="text-red-500">*</span>
                </label>
                <textarea id="visi" name="visi" rows="3" required
                          class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 resize-y @error('visi') border-red-500 @else border-gray-300 @enderror">{{ old('visi') }}</textarea>
            </div>

            {{-- Misi --}}
            <div>
                <label for="misi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Misi <span class="text-red-500">*</span>
                </label>
                <textarea id="misi" name="misi" rows="4" required
                          class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 resize-y @error('misi') border-red-500 @else border-gray-300 @enderror">{{ old('misi') }}</textarea>
            </div>

            {{-- Foto --}}
            <div>
                <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Foto <span class="text-gray-400 font-normal">(opsional, maks. 2MB)</span>
                </label>
                <input type="file" id="foto" name="foto" accept="image/jpg,image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-gray-600 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900 dark:file:text-blue-300 @error('foto') border border-red-500 rounded-lg @enderror">

                {{-- Preview --}}
                <div id="foto-preview-wrapper" class="mt-3 hidden">
                    <img id="foto-preview" src="" alt="Preview foto" class="h-40 w-40 object-cover rounded-xl border border-gray-200 dark:border-gray-600">
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('camin.index') }}"
                   class="px-5 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                    Simpan
                </button>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('foto').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const wrapper = document.getElementById('foto-preview-wrapper');
            const preview = document.getElementById('foto-preview');
            if (file) {
                preview.src = URL.createObjectURL(file);
                wrapper.classList.remove('hidden');
            } else {
                wrapper.classList.add('hidden');
            }
        });
    </script>
@endsection
