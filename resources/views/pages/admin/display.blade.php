@extends('layouts.display')
@section('title', 'Display')

@section('content')
    @php
        $qrUrl = $displayQrUrl ?: config('app.url');
        $encodedQrUrl = rawurlencode($qrUrl);
    @endphp

    <div class="h-screen w-full p-4 md:p-6 lg:p-8 overflow-auto lg:overflow-hidden">
        <div class="h-full grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6">
            <section class="lg:col-span-8 flex flex-col gap-4 lg:gap-6 min-h-0">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Display Voting</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pantau statistik real-time untuk layar utama.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Total Peserta</p>
                        <p class="mt-2 text-3xl font-bold text-gray-800 dark:text-white">{{ $totalPeserta }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Sudah Vote</p>
                        <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ $sudahVote }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Belum Vote</p>
                        <p class="mt-2 text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $belumVote }}</p>
                    </div>
                </div>

                <div class="flex-1 min-h-0">
                    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-3">Distribusi Suara Per Paslon</h3>
                    <x-admin.vote-pie-chart
                        :vote-per-paslon="$votePerPaslon"
                        :show-title="false"
                        wrapper-class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5 h-full w-full" />
                </div>
            </section>

            <aside class="lg:col-span-4 min-h-0">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm h-full p-5 md:p-6 flex flex-col items-center justify-center text-center">
                    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4">QR Voting</h3>

                    <div class="bg-white rounded-xl p-3 border border-gray-200 w-fit">
                        <img
                            src="https://api.qrserver.com/v1/create-qr-code/?size=320x320&data={{ $encodedQrUrl }}"
                            alt="QR URL voting"
                            class="w-56 h-56 md:w-64 md:h-64 lg:w-72 lg:h-72"
                            loading="lazy" />
                    </div>

                    <a href="{{ $qrUrl }}" target="_blank"
                       class="mt-4 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition-colors">
                        Buka URL Voting
                    </a>
                    <p class="mt-3 text-xs break-all text-gray-500 dark:text-gray-400">{{ $qrUrl }}</p>
                </div>
            </aside>
        </div>
    </div>
@endsection
