@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="p-8">

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Selamat datang di panel admin Regen 2026.</p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">

                {{-- Total Peserta --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5 flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 shrink-0">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-5.356-3.779M9 20H4v-1a4 4 0 015.356-3.779M15 7a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 11-6 0 3 3 0 016 0zM3 11a3 3 0 116 0 3 3 0 01-6 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Total Peserta</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalPeserta }}</p>
                    </div>
                </div>

                {{-- Sudah Vote --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5 flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 shrink-0">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Sudah Vote</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $sudahVote }}</p>
                    </div>
                </div>

                {{-- Belum Vote --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5 flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900 shrink-0">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Belum Vote</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $belumVote }}</p>
                    </div>
                </div>

                {{-- Calon Admin --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5 flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 shrink-0">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Calon Admin</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalCamin }}</p>
                    </div>
                </div>

            </div>

            {{-- Quick Access --}}
            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4">Akses Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <a href="{{ route('peserta.index') }}"
                   class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 group-hover:bg-blue-200 dark:group-hover:bg-blue-800 transition-colors duration-200 shrink-0">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-5.356-3.779M9 20H4v-1a4 4 0 015.356-3.779M15 7a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 11-6 0 3 3 0 016 0zM3 11a3 3 0 116 0 3 3 0 01-6 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800 dark:text-white">Kelola Peserta</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Lihat, import, edit, dan hapus data peserta</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('camin.index') }}"
                   class="group bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 group-hover:bg-purple-200 dark:group-hover:bg-purple-800 transition-colors duration-200 shrink-0">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800 dark:text-white">Kelola Calon Admin</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Tambah, edit, dan hapus calon admin beserta foto</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 ml-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

            </div>

    </div>
@endsection
