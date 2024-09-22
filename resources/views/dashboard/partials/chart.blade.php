@pushOnce('scripts')
    <script src="/js/chart.js"></script>
@endPushOnce

<div class="rounded-xl shadow bg-white p-8 grow">
    <h1 class="text-xl font-bold  text-gray-800">{{ __('Statistics') }}</h1>
    <div class="mt-4 relative h-80 w-full" id="chartparent">
        <canvas id="chart" class="mt-4 "></canvas>
    </div>
</div>

@pushOnce('scripts')
    <script>
        const currentYearPosyandus = @json($currentYearPosyandus);
        const lastYearPosyandus = @json($lastYearPosyandus);

        const labelsMonth = ['Januari', 'February', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];

        let thisYear = new Array(12).fill();
        let lastYear = new Array(12).fill();

        Object.values(currentYearPosyandus).forEach(element => {
            thisYear[element.month - 1] = element.count;
        });

        Object.values(lastYearPosyandus).forEach(element => {
            lastYear[element.month - 1] = element.count;
        });

        const chart = new Chart(document.getElementById('chart'), {
            type: 'bar',
            data: {
                labels: labelsMonth,
                datasets: [{
                        label: '{{ __('This Year') }}',
                        data: thisYear,
                        backgroundColor: '#06b6d4',
                        borderRadius: 10,
                        borderSkipped: false,
                    },
                    {
                        label: '{{ __('Last Year') }}',
                        data: lastYear,
                        backgroundColor: '#c1edf4',
                        borderRadius: 10,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpushOnce
