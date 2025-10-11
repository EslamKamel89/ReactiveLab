<x-layouts.app :title="__('Chart.js-Line')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">
        <div class="max-w-3xl mx-auto px-4 py-10">
            <h1 class="text-2xl font-semibold mb-6">Chart.js — Line Chart & Axes Customization</h1>

            <!-- Toolbar -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center justify-between">
                <div class="font-medium">Website Traffic</div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 border rounded" @click="toggleDataset(0)">Visits</button>
                    <button class="px-3 py-1.5 border rounded" @click="toggleDataset(1)">Signups</button>
                    <button class="px-3 py-1.5 border rounded" @click="toggleDataset(-1)">All Data</button>
                </div>
            </div>

            <!-- Chart -->
            <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4">
                <div class="relative">
                    <canvas x-ref="canvas" id="trafficChart" class="w-full h-64"></canvas>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.app = () => {
                return {
                    chart: null,
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    visits: [120, 140, 180, 200, 170, 190, 220, 250, 240, 260, 300, 320],
                    signups: [20, 25, 35, 40, 30, 50, 55, 60, 70, 75, 90, 100],
                    datasets: [{
                        label: 'Visits',
                        data: [],
                        borderColor: 'rgb(99,102,241)',
                        backgroundColor: 'rgba(99,102,241,0.15)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Signups',
                        data: [],
                        borderColor: 'rgb(16,185,129)',
                        backgroundColor: 'rgba(16,185,129,0.15)',
                        tension: 0.3,
                        fill: true,
                    }],
                    createChart() {
                        const config = {
                            type: 'line',
                            data: {
                                labels: this.labels,
                                datasets: this.datasets
                            },
                            options: {
                                responsive: true,
                                type: 'line',
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        grid: {
                                            color: 'rgba(0,0,0,0.05)'
                                        },
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: 'rgba(0,0,0,0.05)'
                                        },
                                        ticks: {
                                            stepSize: 50
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    },
                                    tooltip: {
                                        mode: 'index',
                                        intersect: false,
                                        callbacks: {
                                            label: ctx => `${ctx.dataset.label}: ${ctx.formattedValue}`
                                        }
                                    },
                                },
                                interaction: {
                                    mode: 'nearest',
                                    axis: 'x',
                                    intersect: false
                                },
                            }
                        };
                        if (this.chart != null) this.chart.destroy();
                        this.chart = new Chart(this.$refs.canvas, config);
                    },
                    init() {
                        this.datasets[0].data = this.visits;
                        this.datasets[1].data = this.signups;
                        this.createChart();
                        window.chart = this.chart;
                    },
                    toggleDataset(index) {
                        this.datasets[0].data = this.visits;
                        this.datasets[1].data = this.signups;
                        if (index !== -1) {
                            this.datasets[index].data = [];
                        }
                        this.createChart();
                    }
                };
            }
        })
    </script>
</x-layouts.app>