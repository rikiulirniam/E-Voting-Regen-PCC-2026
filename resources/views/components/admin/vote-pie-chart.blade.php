@props([
    'votePerPaslon',
    'title' => 'Distribusi Suara Per Paslon',
    'showTitle' => true,
    'wrapperClass' => 'bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6',
])

@php
    $chartId = 'vote-chart-' . uniqid();
    $labels = $votePerPaslon->map(fn ($p) => 'Paslon ' . $p->no_urut . ' - ' . $p->name)->values();
    $values = $votePerPaslon->pluck('votings_count')->values();
    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];
@endphp

@if ($showTitle)
    <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4">{{ $title }}</h3>
@endif

<div class="{{ $wrapperClass }}">
    @if($votePerPaslon->sum('votings_count') > 0)
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-full md:w-64 h-64">
                <canvas id="{{ $chartId }}"></canvas>
            </div>
            <div class="w-full md:w-auto flex flex-col gap-3">
                @foreach($votePerPaslon as $paslon)
                    <div class="flex items-center gap-3">
                        <span class="inline-block w-4 h-4 rounded-full"
                              style="background-color: {{ $colors[$loop->index % count($colors)] }}"></span>
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Paslon {{ $paslon->no_urut }} -- {{ $paslon->name }}
                        </span>
                        <span class="ml-auto text-sm font-semibold text-gray-800 dark:text-white">
                            {{ $paslon->votings_count }} suara
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-sm text-gray-400 dark:text-gray-500 text-center py-8">Belum ada suara yang masuk.</p>
    @endif
</div>

@once
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
@endonce

@if($votePerPaslon->sum('votings_count') > 0)
    <script>
        (function () {
            var ctx = document.getElementById(@json($chartId));
            if (!ctx || typeof Chart === 'undefined') return;

            var labels = @json($labels);
            var data = @json($values);
            var colors = @json($colors);

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors.slice(0, data.length),
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var total = context.dataset.data.reduce(function (a, b) { return a + b; }, 0);
                                    var pct = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                    return ' ' + context.parsed + ' suara (' + pct + '%)';
                                }
                            }
                        }
                    }
                }
            });
        })();
    </script>
@endif
