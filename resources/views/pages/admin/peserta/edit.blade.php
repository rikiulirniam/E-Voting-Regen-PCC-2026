@extends('layouts.admin')
@section('title', 'Edit Peserta')

@section('content')

    <div class="max-w-2xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Peserta</h1>
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

        {{-- Form --}}
        <form action="{{ route('peserta.update', $peserta) }}" method="POST"
              class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $peserta->name) }}" required
                       class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @else border-gray-300 @enderror">
            </div>

            {{-- NIM --}}
            <div>
                <label for="nim" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    NIM <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nim" name="nim" value="{{ old('nim', $peserta->nim) }}" required
                       class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono @error('nim') border-red-500 @else border-gray-300 @enderror">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $peserta->email) }}" required
                       class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @else border-gray-300 @enderror">
            </div>

            {{-- Username --}}
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" id="username" name="username" value="{{ old('username', $peserta->user->username ?? '') }}" required
                       class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono @error('username') border-red-500 @else border-gray-300 @enderror">
                <p class="mt-1 text-xs text-gray-400">Untuk reset password, gunakan tombol <strong>Kirim Email</strong> di halaman daftar.</p>
            </div>

            {{-- Status Jabatan --}}
            <div>
                <label for="status_jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Status Jabatan <span class="text-red-500">*</span>
                </label>
                <select id="status_jabatan" name="status_jabatan" required
                        class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status_jabatan') border-red-500 @else border-gray-300 @enderror">
                    <option value="anggota aktif" {{ old('status_jabatan', $peserta->status_jabatan) === 'anggota aktif' ? 'selected' : '' }}>
                        Anggota Aktif
                    </option>
                    <option value="STO" {{ old('status_jabatan', $peserta->status_jabatan) === 'STO' ? 'selected' : '' }}>
                        STO
                    </option>
                </select>
            </div>

            {{-- Status Vote --}}
            <div>
                <label for="status_vote" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Status Vote <span class="text-red-500">*</span>
                </label>
                <select id="status_vote" name="status_vote" required
                        class="w-full px-3 py-2 text-sm border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status_vote') border-red-500 @else border-gray-300 @enderror">
                    <option value="belum" {{ old('status_vote', $peserta->status_vote) === 'belum' ? 'selected' : '' }}>
                        Belum
                    </option>
                    <option value="sudah" {{ old('status_vote', $peserta->status_vote) === 'sudah' ? 'selected' : '' }}>
                        Sudah
                    </option>
                </select>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('peserta.index') }}"
                   class="px-5 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                    Perbarui
                </button>
            </div>
        </form>

    </div>
@endsection
