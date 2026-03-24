@extends('layouts.display')
@section('title', 'Display')

@section('content')
    @php
        $qrUrl = $displayQrUrl ?: config('app.url');
        $encodedQrUrl = rawurlencode($qrUrl);
    @endphp

    <div class="h-screen w-full p-4 md:p-6 lg:p-8 overflow-auto lg:overflow-hidden">
        <div class="header py-3">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Display Voting</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 my-1">Pantau statistik real-time untuk layar utama.</p>
        </div>
        <div class="h-9/10 grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6">
            <section class="lg:col-span-8 flex flex-col justify-center gap-4 lg:gap-6 min-h-0">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800  shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Total Peserta</p>
                        <p class="mt-2 text-3xl font-bold text-gray-800 dark:text-white">{{ $totalPeserta }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800  shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Sudah Vote</p>
                        <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ $sudahVote }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800  shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Belum Vote</p>
                        <p class="mt-2 text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $belumVote }}</p>
                    </div>
                </div>

                <div class="flex-1 min-h-0">
                    @php
                        $percentageVoted = $totalPeserta > 0 ? ($sudahVote / $totalPeserta) * 100 : 0;
                        $percentageRemaining = 100 - $percentageVoted;
                    @endphp

                    <div class="bg-white dark:bg-gray-800  shadow-sm p-6 w-full flex flex-col  justify-center">

                        <div class="flex-1 flex flex-col justify-center gap-8">
                            <h3 class="text-sm text-center font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-6">Progress Voting</h3>
                            <div>

                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-12 overflow-hidden flex">
                                    <div class="h-full bg-green-500 transition-all duration-500 flex items-center justify-center"
                                         style="width: {{ $percentageVoted }}%">
                                        <span class="text-white font-bold text-sm">{{ round($percentageVoted, 1) }}%</span>
                                    </div>
                                    <div class="h-full bg-amber-500 transition-all duration-500 flex items-center justify-center"
                                         style="width: {{ $percentageRemaining }}%">
                                        <span class="text-white font-bold text-sm">{{ round($percentageRemaining, 1) }}%</span>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
                                        <span class="text-gray-600  dark:text-gray-400">Sudah Vote</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full bg-amber-500"></span>
                                        <span class="text-gray-600  dark:text-gray-400">Belum Vote</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <aside class="lg:col-span-4 min-h-0">
                <div class="bg-white dark:bg-gray-800 shadow-sm  p-5 md:p-6 flex flex-col items-center justify-center text-center">
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
