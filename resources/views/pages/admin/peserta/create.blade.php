@extends('layouts.admin')
@section('title', 'Import Peserta')

@section('content')

    <div class="max-w-2xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Import Peserta via CSV</h1>
            <a href="{{ route('peserta.index') }}"
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

        {{-- Petunjuk Format --}}
        <div class="mb-6 bg-blue-50 dark:bg-blue-950 border border-blue-200 dark:border-blue-800 rounded-xl p-5">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 110 20A10 10 0 0112 2z"/>
                </svg>
                <div class="text-sm text-blue-800 dark:text-blue-200">
                    <p class="font-semibold mb-2">Format CSV yang diperlukan:</p>
                    <div class="overflow-x-auto">
                        <table class="text-xs border-collapse mb-3">
                            <thead>
                                <tr class="bg-blue-100 dark:bg-blue-900">
                                    <th class="border border-blue-300 dark:border-blue-700 px-2 py-1">name</th>
                                    <th class="border border-blue-300 dark:border-blue-700 px-2 py-1">nim</th>
                                    <th class="border border-blue-300 dark:border-blue-700 px-2 py-1">email</th>
                                    <th class="border border-blue-300 dark:border-blue-700 px-2 py-1">status_jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-blue-300 dark:border-blue-700 px-2 py-1">Nama Peserta</td>
                                    <td class="border border-blue-300 dark:border-blue-700 px-2 py-1">2024001</td>
                                    <td class="border border-blue-300 dark:border-blue-700 px-2 py-1">peserta@email.com</td>
                                    <td class="border border-blue-300 dark:border-blue-700 px-2 py-1">anggota aktif</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                        <li>Baris pertama adalah header (akan dilewati otomatis).</li>
                        <li><strong>Username</strong> dan <strong>password</strong> akan di-generate otomatis dan dikirim ke email masing-masing peserta.</li>
                        <li><strong>status_jabatan</strong>: <code>anggota aktif</code> atau <code>STO</code> (default: <code>anggota aktif</code> jika kosong).</li>
                        <li>NIM dan email harus unik — baris duplikat akan dilewati.</li>
                        <li>Simpan file Excel sebagai <strong>CSV (Comma delimited)</strong> sebelum upload.</li>
                    </ul>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-blue-200 dark:border-blue-800">
                <a href="{{ route('peserta.template') }}"
                   class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-700 dark:text-blue-300 hover:underline">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V3m0 9l-3-3m3 3l3-3"/>
                    </svg>
                    Download Template CSV
                </a>
            </div>
        </div>

        {{-- Form Upload --}}
        <form action="{{ route('peserta.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 space-y-5">
            @csrf

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Pilih File CSV <span class="text-red-500">*</span>
                </label>

                {{-- Drop zone --}}
                <label for="file"
                       id="drop-zone"
                       class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer transition-colors duration-200
                              border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700
                              hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-950 dark:hover:border-blue-600
                              @error('file') border-red-400 @enderror">
                    <div id="drop-zone-content" class="flex flex-col items-center gap-2 text-gray-400 dark:text-gray-500 pointer-events-none">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V6a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm font-medium">Klik atau seret file CSV ke sini</p>
                        <p class="text-xs">Maksimal 5MB</p>
                    </div>
                    <p id="file-name" class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400 hidden pointer-events-none"></p>
                    <input type="file" id="file" name="file" accept=".csv,text/csv,text/plain" class="hidden">
                </label>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('peserta.index') }}"
                   class="px-5 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                    Import Sekarang
                </button>
            </div>
        </form>

    </div>

    <script>
        const input = document.getElementById('file');
        const dropZone = document.getElementById('drop-zone');
        const content = document.getElementById('drop-zone-content');
        const fileNameEl = document.getElementById('file-name');

        function showFileName(name) {
            content.classList.add('hidden');
            fileNameEl.textContent = '✓ ' + name;
            fileNameEl.classList.remove('hidden');
        }

        input.addEventListener('change', function () {
            if (this.files.length > 0) {
                showFileName(this.files[0].name);
            }
        });

        dropZone.addEventListener('dragover', function (e) {
            e.preventDefault();
            this.classList.add('border-blue-400', 'bg-blue-50');
        });

        dropZone.addEventListener('dragleave', function () {
            this.classList.remove('border-blue-400', 'bg-blue-50');
        });

        dropZone.addEventListener('drop', function (e) {
            e.preventDefault();
            this.classList.remove('border-blue-400', 'bg-blue-50');
            const file = e.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                showFileName(file.name);
            }
        });
    </script>
@endsection
