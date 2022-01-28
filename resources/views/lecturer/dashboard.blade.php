<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-2xl font-medium text-gray-800"><span class="font-bold">Hi {{ $user->name }}</span>, Welcome
            Back!</h1>

        <livewire:lecturer.analytics.overview />

        <div class="mt-8 lg:grid lg:grid-cols-5 lg:gap-8">
            <div class="lg:col-span-3">
                <livewire:lecturer.analytics.chart />
            </div>

            <div class="mt-8 lg:mt-2.5 col-span-2">
                <div class="flex justify-between items-center">
                    <h3 class="text-gray-600">Last Activity</h3>
                    <a href="" class="text-sm text-gray-600 hover:text-blue-500">Show more</a>
                </div>

                <div class="mt-6">
                    <livewire:lecturer.latest-submission />
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"
            integrity="sha256-Y26AMvaIfrZ1EQU49pf6H4QzVTrOI8m9wQYKkftBt4s=" crossorigin="anonymous"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const ctx = document.querySelector('#myChart');

                const chartTitle = (year) => [`Jan ${year}`, `Feb ${year}`, `Mar ${year}`, `Apr ${year}`, `Mey ${year}`, `Jun ${year}`, `Jul ${year}`, `Aug ${year}`, `Sep ${year}`, `Oct ${year}`, `Nov ${year}`, `Dec ${year}`];
                const chartDatasetOptions = {
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1,
                };

                const chartDataset = (dataset) => {
                    return dataset.map(item => ({...item, ...chartDatasetOptions}));
                };

                let analyticsChart;

                Livewire.on('initAnalyticsChart', (year, dataset) => {
                    analyticsChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: chartTitle(year),
                            datasets: chartDataset(dataset)
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });

                Livewire.on('updateAnalyticsChart', (year, dataset) => {
                    analyticsChart.data.labels = chartTitle(year);
                    analyticsChart.data.datasets = chartDataset(dataset);
                })
            });
        </script>

    </x-slot>

</x-app-layout>
