<x-layouts.app :title="__('Quill')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">
        <div class="max-w-3xl mx-auto px-4 py-10">
            <h1 class="text-2xl font-semibold mb-6">Chart.js — Bar</h1>

            <!-- Toolbar (static for now) -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center justify-between">
                <div class="font-medium">Monthly Sales</div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 border rounded" @click="randomize()">Randomize</button>
                    <button class="px-3 py-1.5 border rounded" @click="reset()">Reset</button>
                </div>
            </div>

            <!-- Chart area -->
            <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4">
                <div class="relative">
                    <canvas x-ref="canvas" id="salesChart" class="w-full h-64"></canvas>
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
                    baseData: [12, 19, 13, 15, 12, 17, 21, 18, 14, 22, 25, 20],
                    data: [],
                    init() {
                        this.data = [...this.baseData];
                        this.createChart()
                        window.chart = this.chart;
                    },
                    createChart() {
                        const config = {
                            type: 'bar',
                            data: {
                                labels: this.labels,
                                datasets: [{
                                    label: 'Sales',
                                    data: this.data,
                                    backgroundColor: 'rgba(99, 102, 241, 0.25)', // indigo-500 @ 25%
                                    borderColor: 'rgb(99, 102, 241)',
                                    borderWidth: 1,
                                    borderRadius: 6,
                                    hoverBackgroundColor: 'rgba(99, 102, 241, 0.45)',
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: 'rgba(0,0,0,0.06)'
                                        },
                                        ticks: {
                                            stepSize: 5
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true
                                    },
                                    tooltip: {
                                        enabled: true
                                    }
                                },
                                animation: {
                                    duration: 300
                                }
                            }
                        };
                        if (this.chart != null) this.chart.destroy();
                        this.chart = new Chart(this.$refs.canvas, config);
                    },
                    randomize() {
                        this.data = this.labels.map(() => Math.floor(Math.random() * 26));
                        this.chart.data.datasets[0] = this.data;
                        this.createChart();
                    },
                    reset() {
                        this.data = [...this.baseData];
                        this.createChart();

                    }
                }
            }
        })
    </script>
</x-layouts.app>