@extends('layouts.admin')
@section('title', 'Data Peserta')

@section('content')

    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Data Peserta</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('peserta.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12"/>
                    </svg>
                    Import CSV
                </a>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Import Errors --}}
        @if(session('import_errors') && count(session('import_errors')) > 0)
            <div class="mb-4 px-4 py-3 rounded-lg bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 text-sm">
                <p class="font-semibold mb-1">Beberapa baris dilewati:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach(session('import_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Search --}}
        <form method="GET" action="{{ route('peserta.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama, NIM, atau email..."
                   class="flex-1 min-w-0 px-3 py-2 text-sm border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit"
                    class="px-4 py-2 text-sm font-medium bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white rounded-lg transition-colors duration-200">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('peserta.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    Reset
                </a>
            @endif
        </form>

        {{-- Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">NIM</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3">Status Jabatan</th>
                            <th class="px-4 py-3">Status Vote</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($pesertas as $peserta)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400">
                                    {{ $pesertas->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800 dark:text-white">
                                    {{ $peserta->name }}
                                </td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-300 font-mono">
                                    {{ $peserta->nim }}
                                </td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                    {{ $peserta->email }}
                                </td>
                                <td class="px-4 py-3 font-mono text-gray-600 dark:text-gray-300">
                                    {{ $peserta->user->username ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ $peserta->status_jabatan === 'STO'
                                            ? 'bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300'
                                            : 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300' }}">
                                        {{ $peserta->status_jabatan }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ $peserta->status_vote === 'sudah'
                                            ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
                                            : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' }}">
                                        {{ $peserta->status_vote }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('peserta.edit', $peserta) }}"
                                           class="text-xs font-medium px-2.5 py-1 rounded-lg bg-yellow-100 hover:bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 transition-colors duration-200">
                                            Edit
                                        </a>
                                        <form action="{{ route('peserta.send-credentials', $peserta) }}" method="POST"
                                              onsubmit="return confirm('Kirim ulang kredensial ke {{ $peserta->email }}? Password lama akan diganti.')">
                                            @csrf
                                            <button type="submit"
                                                    class="text-xs font-medium px-2.5 py-1 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-700 dark:bg-blue-900 dark:text-blue-200 transition-colors duration-200">
                                                Kirim Email
                                            </button>
                                        </form>
                                        <form action="{{ route('peserta.destroy', $peserta) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-xs font-medium px-2.5 py-1 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900 dark:text-red-200 transition-colors duration-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center text-gray-400 dark:text-gray-500">
                                    Belum ada data peserta.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($pesertas->hasPages())
                <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700">
                    {{ $pesertas->links() }}
                </div>
            @endif
        </div>

        {{-- Total count --}}
        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
            Menampilkan {{ $pesertas->firstItem() ?? 0 }}–{{ $pesertas->lastItem() ?? 0 }} dari {{ $pesertas->total() }} peserta
        </p>

    </div>
@endsection
