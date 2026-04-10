@extends('layouts.display')
@section('title', 'Display')

@section('content')
    @php
        $qrUrl = $displayQrUrl ?: config('app.url');
        $encodedQrUrl = rawurlencode($qrUrl);
    @endphp

    <div class="h-screen w-full p-4 md:p-6 lg:p-8 overflow-auto lg:overflow-hidden">
        <div class="header py-3">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Display Voting</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 my-1">Pantau statistik real-time untuk layar utama.</p>
                </div>
                <button type="button" id="display-timer-trigger"
                    class="inline-flex opacity-0 items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition-colors">
                    Atur Timer
                </button>
            </div>
        </div>
        <div class="h-9/10 grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-6">
            <section class="lg:col-span-8 flex flex-col justify-center gap-4 lg:gap-6 min-h-0">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800  shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Total Peserta</p>
                        <p id="display-total-peserta" class="mt-2 text-3xl font-bold text-gray-800 dark:text-white">{{ $totalPeserta }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800  shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Sudah Vote</p>
                        <p id="display-sudah-vote" class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ $sudahVote }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800  shadow-sm p-5">
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide font-medium">Belum Vote</p>
                        <p id="display-belum-vote" class="mt-2 text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $belumVote }}</p>
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
                                    <div id="display-progress-voted" class="h-full bg-green-500 transition-all duration-500 flex items-center justify-center"
                                         style="width: {{ $percentageVoted }}%">
                                        <span id="display-progress-voted-text" class="text-white font-bold text-sm">{{ round($percentageVoted, 1) }}%</span>
                                    </div>
                                    <div id="display-progress-remaining" class="h-full bg-amber-500 transition-all duration-500 flex items-center justify-center"
                                         style="width: {{ $percentageRemaining }}%">
                                        <span id="display-progress-remaining-text" class="text-white font-bold text-sm">{{ round($percentageRemaining, 1) }}%</span>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
                                        <span id="display-progress-voted-count" class="text-gray-600  dark:text-gray-400">Sudah Vote ({{ $sudahVote }})</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full bg-amber-500"></span>
                                        <span id="display-progress-remaining-count" class="text-gray-600  dark:text-gray-400">Belum Vote ({{ $belumVote }})</span>
                                    </div>
                                </div>

                                <div id="display-countdown-box"
                                    class="mt-8 rounded-2xl bg-gray-900 text-white p-6 md:p-8 text-center border border-gray-700 shadow-lg cursor-pointer">
                                    <p class="text-sm uppercase tracking-widest text-gray-300">Countdown</p>
                                    <p id="display-countdown-text" class="text-6xl md:text-7xl font-bold leading-none mt-3">00:00:00</p>
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

    <div id="display-timer-overlay" class="hidden fixed inset-0 z-50 items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative w-full max-w-sm rounded-xl bg-white dark:bg-gray-800 shadow-2xl p-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Atur Countdown Display</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Masukkan durasi timer dalam menit.</p>
            <input id="display-timer-minutes" type="number" min="1" max="180" value="5"
                class="mt-4 w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 px-3 py-2 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Batas: 1 sampai 180 menit.</p>
            <div class="mt-5 flex gap-3">
                <button type="button" id="display-timer-cancel"
                    class="flex-1 rounded-lg border border-gray-300 dark:border-gray-600 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">Batal</button>
                <button type="button" id="display-timer-start"
                    class="flex-1 rounded-lg bg-indigo-600 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition-colors">Mulai</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            const statsUrl = @json(route('admin.display.stats'));
            const countdownStorageKey = 'adminDisplayCountdownEndAt';

            const totalPesertaEl = document.getElementById('display-total-peserta');
            const sudahVoteEl = document.getElementById('display-sudah-vote');
            const belumVoteEl = document.getElementById('display-belum-vote');
            const progressVotedEl = document.getElementById('display-progress-voted');
            const progressVotedTextEl = document.getElementById('display-progress-voted-text');
            const progressRemainingEl = document.getElementById('display-progress-remaining');
            const progressRemainingTextEl = document.getElementById('display-progress-remaining-text');
            const progressVotedCountEl = document.getElementById('display-progress-voted-count');
            const progressRemainingCountEl = document.getElementById('display-progress-remaining-count');
            const displayTimerTriggerEl = document.getElementById('display-timer-trigger');
            const displayTimerOverlayEl = document.getElementById('display-timer-overlay');
            const displayTimerMinutesEl = document.getElementById('display-timer-minutes');
            const displayTimerCancelEl = document.getElementById('display-timer-cancel');
            const displayTimerStartEl = document.getElementById('display-timer-start');
            const displayCountdownBoxEl = document.getElementById('display-countdown-box');
            const displayCountdownTextEl = document.getElementById('display-countdown-text');

            let countdownIntervalId = null;
            let countdownEndAt = null;

            function formatCountdown(totalMilliseconds) {
                const safeMilliseconds = Math.max(0, totalMilliseconds);
                const totalSeconds = Math.floor(safeMilliseconds / 1000);
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                const centiseconds = Math.floor((safeMilliseconds % 1000) / 10);

                return String(minutes).padStart(2, '0')
                    + ':' + String(seconds).padStart(2, '0')
                    + ':' + String(centiseconds).padStart(2, '0');
            }

            function closeTimerPopup() {
                displayTimerOverlayEl.classList.add('hidden');
                displayTimerOverlayEl.classList.remove('flex');
            }

            function saveCountdownState() {
                if (!countdownEndAt) {
                    localStorage.removeItem(countdownStorageKey);
                    return;
                }

                localStorage.setItem(countdownStorageKey, String(countdownEndAt));
            }

            function restoreCountdownState() {
                const savedEndAt = Number(localStorage.getItem(countdownStorageKey));
                if (!Number.isFinite(savedEndAt) || savedEndAt <= Date.now()) {
                    localStorage.removeItem(countdownStorageKey);
                    displayCountdownTextEl.textContent = '00:00:00';
                    return;
                }

                countdownEndAt = savedEndAt;
                displayCountdownTextEl.textContent = formatCountdown(countdownEndAt - Date.now());

                countdownIntervalId = setInterval(function () {
                    const remainingMilliseconds = Math.max(0, countdownEndAt - Date.now());
                    displayCountdownTextEl.textContent = formatCountdown(remainingMilliseconds);

                    if (remainingMilliseconds <= 0) {
                        stopCountdown(true);
                    }
                }, 50);
            }

            function openTimerPopup() {
                displayTimerOverlayEl.classList.remove('hidden');
                displayTimerOverlayEl.classList.add('flex');
                displayTimerMinutesEl.focus();
                displayTimerMinutesEl.select();
            }

            function stopCountdown(showDoneAlert) {
                if (countdownIntervalId) {
                    clearInterval(countdownIntervalId);
                    countdownIntervalId = null;
                }
                countdownEndAt = null;
                saveCountdownState();
                if (showDoneAlert) {
                    displayCountdownTextEl.textContent = '00:00:00';
                    alert('Waktu countdown selesai.');
                }
            }

            function startCountdown(minutes) {
                stopCountdown(false);

                const safeMinutes = Math.max(1, Math.min(180, minutes));
                const totalMilliseconds = safeMinutes * 60 * 1000;
                countdownEndAt = Date.now() + totalMilliseconds;
                saveCountdownState();
                displayCountdownBoxEl.classList.remove('hidden');
                displayCountdownTextEl.textContent = formatCountdown(totalMilliseconds);

                countdownIntervalId = setInterval(function () {
                    const remainingMilliseconds = Math.max(0, countdownEndAt - Date.now());
                    displayCountdownTextEl.textContent = formatCountdown(remainingMilliseconds);

                    if (remainingMilliseconds <= 0) {
                        stopCountdown(true);
                    }
                }, 50);
            }

            displayTimerTriggerEl.addEventListener('click', openTimerPopup);
            displayCountdownBoxEl.addEventListener('click', openTimerPopup);

            displayTimerCancelEl.addEventListener('click', closeTimerPopup);
            displayTimerStartEl.addEventListener('click', function () {
                const minutes = Number(displayTimerMinutesEl.value);
                if (!Number.isFinite(minutes) || minutes < 1 || minutes > 180) {
                    alert('Masukkan menit antara 1 sampai 180.');
                    displayTimerMinutesEl.focus();
                    return;
                }

                startCountdown(minutes);
                closeTimerPopup();
            });

            displayTimerOverlayEl.addEventListener('click', function (event) {
                if (event.target === displayTimerOverlayEl) {
                    closeTimerPopup();
                }
            });

            restoreCountdownState();

            async function refreshStats() {
                try {
                    const response = await fetch(statsUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        cache: 'no-store',
                    });

                    if (!response.ok) {
                        return;
                    }

                    const stats = await response.json();

                    totalPesertaEl.textContent = stats.totalPeserta;
                    sudahVoteEl.textContent = stats.sudahVote;
                    belumVoteEl.textContent = stats.belumVote;

                    progressVotedEl.style.width = stats.percentageVoted + '%';
                    progressRemainingEl.style.width = stats.percentageRemaining + '%';
                    progressVotedTextEl.textContent = stats.percentageVoted.toFixed(1) + '%';
                    progressRemainingTextEl.textContent = stats.percentageRemaining.toFixed(1) + '%';
                    progressVotedCountEl.textContent = 'Sudah Vote (' + stats.sudahVote + ')';
                    progressRemainingCountEl.textContent = 'Belum Vote (' + stats.belumVote + ')';
                } catch (error) {
                    // Ignore temporary network errors and retry in next interval.
                }
            }

            setInterval(refreshStats, 5000);
            refreshStats();
        })();
    </script>
@endsection
