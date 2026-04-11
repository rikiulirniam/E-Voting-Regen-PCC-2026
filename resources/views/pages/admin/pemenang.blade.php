@extends('layouts.display')
@section('title', 'Pemenang')

@section('content')
    @php
        $featuredWinner = $winners->first();
        $featuredPercentage = ($totalVotes > 0 && $featuredWinner)
            ? round(($featuredWinner->votings_count / $totalVotes) * 100, 2)
            : 0;
    @endphp

    <section id="winner-intro" class="winner-intro-stage relative min-h-screen flex items-center justify-center px-6 py-10 bg-gradient-to-br from-slate-800 via-slate-700 to-emerald-800">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 20%, #ffffff 1px, transparent 1px); background-size: 22px 22px;"></div>
        <div class="relative z-10 text-center">
            <p class="winner-intro-label text-sm uppercase tracking-[0.35em] text-emerald-200 mb-4">Hasil Voting 2026</p>
            <h2 class="winner-intro-heading text-3xl md:text-5xl font-extrabold text-white mb-8">Pengumuman Pemenang</h2>
            <button id="show-winner-btn" type="button"
                class="winner-cta-btn inline-flex items-center justify-center rounded-2xl px-8 py-4 text-base md:text-lg font-semibold text-slate-800 bg-emerald-300 hover:bg-emerald-200 transition-colors shadow-xl">
                Tampilkan Pemenang
            </button>
        </div>
    </section>

    <section id="winner-result" class="winner-result-stage hidden">
        <section class="relative min-h-screen px-6 md:px-10 py-8 md:py-10 bg-gradient-to-b from-gray-900 via-slate-900 to-black text-white flex items-center justify-center">
            <div id="winner-suspense" class="winner-suspense-layer hidden" aria-live="polite">
                <p class="winner-suspense-title winner-drum">&#129345;</p>
            </div>
            <div class="w-full max-w-6xl mx-auto flex items-center justify-center">
                @if ($maxVotes === 0 || !$featuredWinner)
                    <div class="w-full text-center">
                        <h3 class="text-3xl md:text-5xl font-bold">Pemenang Belum Tersedia</h3>
                        <p class="mt-4 text-gray-300">Belum ada suara yang masuk, jadi pemenang belum dapat ditentukan.</p>
                    </div>
                @else
                    <div class="winner-main-grid grid grid-cols-1 lg:grid-cols-2 gap-10 items-center w-full">
                        <div class="winner-copy order-2 lg:order-1">
                            <p class="winner-kicker text-md uppercase tracking-[0.25em] text-emerald-300">Administrator 2026/2027</p>
                            <p class="winner-kicker text-xs uppercase tracking-[0.25em] text-emerald-300">Polytechnic Computer Club</p>
                            <h3 class="winner-title mt-4 text-4xl md:text-6xl font-black leading-tight">{{ $featuredWinner->name }}</h3>
                            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="winner-stat-card rounded-xl border border-white/20 bg-white/10 p-4">
                                    <p class="text-xs uppercase tracking-wide text-gray-300">Nomor Urut</p>
                                    <p class="text-3xl font-bold mt-2">{{ $featuredWinner->no_urut }}</p>
                                </div>
                                <div class="winner-stat-card rounded-xl border border-white/20 bg-white/10 p-4">
                                    <p class="text-xs uppercase tracking-wide text-gray-300">Suara Diperoleh</p>
                                    <p class="text-3xl font-bold mt-2">{{ $featuredWinner->votings_count }}</p>
                                </div>
                                <div class="winner-stat-card rounded-xl border border-white/20 bg-white/10 p-4">
                                    <p class="text-xs uppercase tracking-wide text-gray-300">Persentase</p>
                                    <p class="text-3xl font-bold mt-2">{{ $featuredPercentage }}%</p>
                                </div>
                            </div>
                            @if ($isTie)
                                <p class="mt-5 text-sm text-amber-200">Terdapat hasil seri. Kandidat di atas ditampilkan berdasarkan urutan nomor terkecil.</p>
                            @endif
                        </div>

                        <div class="winner-photo-wrap order-1 lg:order-2">
                            <div class="winner-photo-card w-full max-w-md mx-auto rounded-3xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                                @if ($featuredWinner->foto_url)
                                    <img src="{{ $featuredWinner->foto_url }}" alt="Foto {{ $featuredWinner->name }}"
                                        class="w-full aspect-[4/5] object-cover rounded-2xl">
                                @else
                                    <div class="w-full aspect-[4/5] rounded-2xl bg-gray-700 flex items-center justify-center text-gray-300 text-center px-6">
                                        Foto administrator belum tersedia
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <section id="winner-table" class="min-h-screen px-4 md:px-8 py-10 bg-gray-100 dark:bg-gray-900 flex items-center">
            <div class="w-full max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 md:p-8">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                    <h4 class="text-xl font-bold text-gray-800 dark:text-white">Tabel Pendapatan Suara</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total suara : {{ $totalVotes }}</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 pr-4 text-gray-500 dark:text-gray-400 font-medium">No. Urut</th>
                                <th class="py-3 pr-4 text-gray-500 dark:text-gray-400 font-medium">Nama Calon</th>
                                <th class="py-3 pr-4 text-gray-500 dark:text-gray-400 font-medium">Suara </th>
                                <th class="py-3 text-gray-500 dark:text-gray-400 font-medium">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($candidates as $candidate)
                                @php
                                    $percentage = $totalVotes > 0 ? round(($candidate->votings_count / $totalVotes) * 100, 2) : 0;
                                @endphp
                                <tr class="border-b border-gray-100 dark:border-gray-700/70">
                                    <td class="py-3 pr-4 font-semibold text-gray-800 dark:text-white">{{ $candidate->no_urut }}</td>
                                    <td class="py-3 pr-4 text-gray-700 dark:text-gray-200">{{ $candidate->name }}</td>
                                    <td class="py-3 pr-4 text-gray-700 dark:text-gray-200">{{ $candidate->votings_count }}</td>
                                    <td class="py-3 text-gray-700 dark:text-gray-200">{{ $percentage }}%</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-500 dark:text-gray-400">Belum ada data calon admin.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>

    <canvas id="winner-confetti-canvas" class="winner-confetti-canvas hidden" aria-hidden="true"></canvas>
@endsection

@section('scripts')
    <style>
        html,
        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        .winner-cta-btn {
            background-color: #6ee7b7;
            color: #0f172a;
            border-radius: 1rem;
            padding: 1rem 2rem;
            font-size: clamp(1rem, 1.2vw, 1.125rem);
            font-weight: 700;
            animation: pulseGlow 2.1s ease-in-out infinite;
        }

        .winner-cta-btn:hover {
            background-color: #a7f3d0;
        }

        .winner-intro-label {
            color: #a7f3d0;
        }

        .winner-intro-heading {
            color: #ffffff;
        }

        .winner-confetti-canvas {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 70;
        }

        .winner-intro-stage.intro-exit {
            animation: introFadeOut 0.55s ease forwards;
        }

        .winner-suspense-layer {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: radial-gradient(circle at center, rgba(8, 17, 27, 0.65) 0%, rgba(2, 6, 10, 0.92) 70%);
            z-index: 20;
            opacity: 0;
            pointer-events: none;
            transition: opacity 220ms ease;
        }

        .winner-result-stage.is-waiting .winner-suspense-layer {
            opacity: 1;
        }

        .winner-suspense-title {
            font-size: clamp(1.5rem, 4vw, 2.4rem);
            font-weight: 800;
            letter-spacing: 0.06em;
            color: #d1fae5;
            text-shadow: 0 0 18px rgba(16, 185, 129, 0.35);
            animation: suspensePulse 1s ease-in-out infinite;
        }

        .winner-drum {
            font-size: clamp(5.5rem, 16vw, 10rem);
            line-height: 1.1;
            display: inline-block;
            font-family: "Segoe UI Emoji", "Apple Color Emoji", "Noto Color Emoji", sans-serif;
            font-weight: 400;
            letter-spacing: 0;
            filter: drop-shadow(0 0 14px rgba(16, 185, 129, 0.35));
            animation: drumSwing 0.5s ease-in-out infinite alternate;
            transform-origin: 50% 70%;
            transform: scaleY(0.82);
        }

        .winner-suspense-sub {
            margin-top: 0.8rem;
            font-size: 0.95rem;
            color: rgba(229, 231, 235, 0.88);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .winner-result-stage .winner-copy,
        .winner-result-stage .winner-photo-card,
        .winner-result-stage .winner-kicker,
        .winner-result-stage .winner-title,
        .winner-result-stage .winner-stat-card,
        .winner-result-stage .winner-scroll-note {
            opacity: 0;
        }

        .winner-result-stage .winner-copy {
            transform: translateY(16px);
        }

        .winner-result-stage.is-revealed .winner-copy {
            animation: fadeUp 0.55s ease 1.02s forwards;
        }

        .winner-result-stage.is-revealed .winner-kicker {
            animation: fadeUp 0.45s ease 1.08s forwards;
        }

        .winner-result-stage.is-revealed .winner-title {
            animation: fadeUp 0.5s ease 1.2s forwards;
        }

        .winner-result-stage.is-revealed .winner-photo-card {
            animation: photoReveal 0.85s cubic-bezier(0.2, 0.8, 0.2, 1) 0.12s forwards;
        }

        .winner-result-stage.is-revealed .winner-stat-card:nth-child(1) {
            animation: fadeUp 0.45s ease 1.34s forwards;
        }

        .winner-result-stage.is-revealed .winner-stat-card:nth-child(2) {
            animation: fadeUp 0.45s ease 1.48s forwards;
        }

        .winner-result-stage.is-revealed .winner-stat-card:nth-child(3) {
            animation: fadeUp 0.45s ease 1.62s forwards;
        }

        .winner-result-stage.is-revealed .winner-scroll-note {
            animation: fadeUp 0.5s ease 1.78s forwards;
        }

        @keyframes introFadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(1.04);
                filter: blur(6px);
            }
        }

        @keyframes photoReveal {
            from {
                opacity: 0;
                transform: translateY(24px) scale(0.92) rotate(-1deg);
                box-shadow: 0 0 0 rgba(16, 185, 129, 0);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1) rotate(0deg);
                box-shadow: 0 0 40px rgba(16, 185, 129, 0.24);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.25);
            }
            50% {
                box-shadow: 0 10px 36px rgba(16, 185, 129, 0.45);
            }
        }

        @keyframes suspensePulse {
            0%, 100% {
                opacity: 0.75;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.03);
            }
        }

        @keyframes drumSwing {
            from {
                transform: rotate(-7deg) scaleY(0.82);
            }
            to {
                transform: rotate(7deg) scaleY(0.82);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .winner-cta-btn,
            .winner-intro-stage.intro-exit,
            .winner-result-stage.is-revealed .winner-copy,
            .winner-result-stage.is-revealed .winner-kicker,
            .winner-result-stage.is-revealed .winner-title,
            .winner-result-stage.is-revealed .winner-photo-card,
            .winner-result-stage.is-revealed .winner-stat-card,
            .winner-result-stage.is-revealed .winner-scroll-note,
            .winner-suspense-title {
                animation: none;
                opacity: 1;
                transform: none;
            }

            .winner-drum {
                animation: none;
            }
        }
    </style>

    <script>
        (function () {
            const showWinnerButton = document.getElementById('show-winner-btn');
            const introSection = document.getElementById('winner-intro');
            const winnerResultSection = document.getElementById('winner-result');
            const suspenseLayer = document.getElementById('winner-suspense');
            const winnerAudio = window.WINNER_AUDIO || {};
            const drumrollAudioEl = winnerAudio.drumrollUrl ? new Audio(winnerAudio.drumrollUrl) : null;
            const tadaaAudioEl = winnerAudio.tadaaUrl ? new Audio(winnerAudio.tadaaUrl) : null;
            const confettiCanvas = document.getElementById('winner-confetti-canvas');
            let confettiHasPlayed = false;
            let audioCtx = null;

            if (drumrollAudioEl) {
                drumrollAudioEl.preload = 'auto';
            }

            if (tadaaAudioEl) {
                tadaaAudioEl.preload = 'auto';
            }

            async function getAudioContext() {
                const AudioContextClass = window.AudioContext || window.webkitAudioContext;
                if (!AudioContextClass) {
                    return null;
                }

                if (!audioCtx || audioCtx.state === 'closed') {
                    audioCtx = new AudioContextClass();
                }

                if (audioCtx.state === 'suspended') {
                    await audioCtx.resume();
                }

                return audioCtx;
            }

            function playAudio(audioEl, volume) {
                if (!audioEl) {
                    return;
                }

                audioEl.pause();
                audioEl.currentTime = 0;
                audioEl.volume = volume;
                const playPromise = audioEl.play();
                if (playPromise && typeof playPromise.catch === 'function') {
                    playPromise.catch(function () {
                        // Ignore playback block and continue visual flow.
                    });
                }
            }

            async function playFallbackDrumroll(durationMs) {
                const ctx = await getAudioContext();
                if (!ctx) {
                    return;
                }

                const now = ctx.currentTime + 0.01;
                const duration = Math.max(0.5, durationMs / 1000);

                const master = ctx.createGain();
                master.gain.setValueAtTime(0.0001, now);
                master.gain.exponentialRampToValueAtTime(0.13, now + 0.08);
                master.gain.setValueAtTime(0.13, now + Math.max(0.2, duration - 0.3));
                master.gain.exponentialRampToValueAtTime(0.0001, now + duration);
                master.connect(ctx.destination);

                let t = now;
                let i = 0;
                while (t < now + duration - 0.05) {
                    const progress = Math.min(1, i / 24);
                    const interval = 0.32 - (0.2 * progress);

                    const osc = ctx.createOscillator();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(120 - (28 * progress), t);
                    osc.frequency.exponentialRampToValueAtTime(55, t + 0.11);

                    const gain = ctx.createGain();
                    gain.gain.setValueAtTime(0.0001, t);
                    gain.gain.exponentialRampToValueAtTime(0.2, t + 0.01);
                    gain.gain.exponentialRampToValueAtTime(0.0001, t + 0.15);

                    osc.connect(gain);
                    gain.connect(master);
                    osc.start(t);
                    osc.stop(t + 0.16);

                    t += Math.max(0.11, interval);
                    i++;
                }
            }

            async function playFallbackTadaa() {
                const ctx = await getAudioContext();
                if (!ctx) {
                    return;
                }

                const now = ctx.currentTime + 0.01;
                const notes = [523.25, 659.25, 783.99];

                const master = ctx.createGain();
                master.gain.setValueAtTime(0.0001, now);
                master.gain.exponentialRampToValueAtTime(0.2, now + 0.04);
                master.gain.exponentialRampToValueAtTime(0.0001, now + 1.1);
                master.connect(ctx.destination);

                notes.forEach(function (note) {
                    const osc = ctx.createOscillator();
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(note, now);
                    osc.frequency.exponentialRampToValueAtTime(note * 1.15, now + 0.35);

                    const gain = ctx.createGain();
                    gain.gain.setValueAtTime(0.0001, now);
                    gain.gain.exponentialRampToValueAtTime(0.11, now + 0.05);
                    gain.gain.exponentialRampToValueAtTime(0.0001, now + 0.9);

                    osc.connect(gain);
                    gain.connect(master);
                    osc.start(now);
                    osc.stop(now + 0.95);
                });
            }

            function launchConfettiOnce() {
                if (confettiHasPlayed || !confettiCanvas) {
                    return;
                }

                confettiHasPlayed = true;

                const ctx = confettiCanvas.getContext('2d');
                if (!ctx) {
                    return;
                }

                const dpr = window.devicePixelRatio || 1;
                const width = window.innerWidth;
                const height = window.innerHeight;

                confettiCanvas.width = Math.floor(width * dpr);
                confettiCanvas.height = Math.floor(height * dpr);
                confettiCanvas.style.width = width + 'px';
                confettiCanvas.style.height = height + 'px';
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

                const colors = ['#22c55e', '#f59e0b', '#0ea5e9', '#ef4444', '#a855f7', '#facc15'];
                const pieces = [];
                const pieceCount = Math.max(120, Math.floor(width / 10));

                for (let i = 0; i < pieceCount; i++) {
                    const fromLeft = i % 2 === 0;
                    pieces.push({
                        x: fromLeft ? -20 : width + 20,
                        y: height * (0.2 + Math.random() * 0.4),
                        vx: fromLeft ? (3 + Math.random() * 4.5) : -(3 + Math.random() * 4.5),
                        vy: -(4 + Math.random() * 8),
                        gravity: 0.12 + Math.random() * 0.06,
                        size: 5 + Math.random() * 9,
                        angle: Math.random() * Math.PI * 2,
                        spin: -0.2 + Math.random() * 0.4,
                        color: colors[Math.floor(Math.random() * colors.length)],
                        life: 120 + Math.random() * 40,
                    });
                }

                confettiCanvas.classList.remove('hidden');

                function draw() {
                    ctx.clearRect(0, 0, width, height);
                    let alive = 0;

                    for (let i = 0; i < pieces.length; i++) {
                        const p = pieces[i];
                        if (p.life <= 0) {
                            continue;
                        }

                        p.vy += p.gravity;
                        p.x += p.vx;
                        p.y += p.vy;
                        p.angle += p.spin;
                        p.life -= 1;

                        if (p.y > height + 30) {
                            p.life = 0;
                            continue;
                        }

                        alive++;
                        ctx.save();
                        ctx.translate(p.x, p.y);
                        ctx.rotate(p.angle);
                        ctx.fillStyle = p.color;
                        ctx.globalAlpha = Math.max(0, p.life / 130);
                        ctx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size * 0.55);
                        ctx.restore();
                    }

                    if (alive > 0) {
                        requestAnimationFrame(draw);
                        return;
                    }

                    ctx.clearRect(0, 0, width, height);
                    confettiCanvas.classList.add('hidden');
                }

                requestAnimationFrame(draw);
            }

            if (!showWinnerButton || !introSection || !winnerResultSection) {
                return;
            }

            showWinnerButton.addEventListener('click', async function () {
                showWinnerButton.disabled = true;
                introSection.classList.add('intro-exit');
                const hasDrumrollFile = !!drumrollAudioEl;
                const hasTadaaFile = !!tadaaAudioEl;

                setTimeout(function () {
                    introSection.classList.add('hidden');
                    winnerResultSection.classList.remove('hidden');
                    winnerResultSection.classList.add('is-waiting');
                    if (suspenseLayer) {
                        suspenseLayer.classList.remove('hidden');
                    }

                    if (hasDrumrollFile) {
                        playAudio(drumrollAudioEl, 0.95);
                    } else {
                        playFallbackDrumroll(5000);
                    }

                    setTimeout(function () {
                        if (hasDrumrollFile && drumrollAudioEl) {
                            drumrollAudioEl.pause();
                            drumrollAudioEl.currentTime = 0;
                        }
                        if (hasTadaaFile) {
                            playAudio(tadaaAudioEl, 1);
                        } else {
                            playFallbackTadaa();
                        }

                        winnerResultSection.classList.remove('is-waiting');
                        if (suspenseLayer) {
                            suspenseLayer.classList.add('hidden');
                        }

                        requestAnimationFrame(function () {
                            winnerResultSection.classList.add('is-revealed');
                            launchConfettiOnce();
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        });
                    }, 5000);
                }, 520);
            });
        })();
    </script>
@endsection
