@extends('layouts.admin')
@section('title', 'Daftar Calon Admin')

@section('content')

    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Daftar Calon Admin</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('camin.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Calon Admin
                </a>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($camin->isEmpty())
            <div class="text-center py-20 text-gray-500 dark:text-gray-400">
                <p class="text-lg">Belum ada data calon admin.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($camin as $item)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden flex flex-col">

                        {{-- Foto --}}
                        <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     alt="Foto {{ $item->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <svg class="w-24 h-24 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                </svg>
                            @endif
                        </div>

                        {{-- Konten --}}
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 font-bold text-sm shrink-0">
                                    {{ $item->no_urut }}
                                </span>
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-white leading-tight">
                                    {{ $item->name }}
                                </h2>
                            </div>

                            <div class="mb-3">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Visi</p>
                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-3">
                                    {{ $item->visi }}
                                </p>
                            </div>

                            <div class="mb-4">
                                <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Misi</p>
                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-4">
                                    {{ $item->misi }}
                                </p>
                            </div>

                            {{-- Actions --}}
                            <div class="mt-auto flex items-center gap-2 pt-3 border-t border-gray-100 dark:border-gray-700">
                                <a href="{{ route('camin.edit', $item) }}"
                                   class="flex-1 text-center text-sm font-medium bg-yellow-100 hover:bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 dark:hover:bg-yellow-800 px-3 py-1.5 rounded-lg transition-colors duration-200">
                                    Edit
                                </a>
                                <form action="{{ route('camin.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus calon admin ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-sm font-medium bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900 dark:text-red-200 dark:hover:bg-red-800 px-3 py-1.5 rounded-lg transition-colors duration-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
