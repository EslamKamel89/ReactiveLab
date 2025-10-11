<x-layouts.app :title="__('Chart.js-Pie')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">
        <div class="max-w-3xl mx-auto px-4 py-10">
            <h1 class="text-2xl font-semibold mb-6">Chart.js — Pie & Doughnut Charts</h1>

            <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center justify-between">
                <div class="font-medium">Browser Market Share</div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 border rounded" @click="randomize()">Randomize</button>
                    <button class="px-3 py-1.5 border rounded" @click="switchType()">Switch Type</button>
                </div>
            </div>

            <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4">
                <div class="relative">
                    <canvas x-ref="canvas" id="browserChart" class="w-full h-64"></canvas>
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
                    type: 'pie', // you could toggle between pi and donut
                    labels: ['Chrome', 'Safari', 'Firefox', 'Edge', 'Other'],
                    data: [58, 20, 10, 8, 4],
                    colors: [
                        '#4F46E5', // indigo
                        '#10B981', // emerald
                        '#F59E0B', // amber
                        '#EF4444', // red
                        '#6B7280' // gray
                    ],
                    createChart() {
                        const config = {
                            type: this.type,
                            data: {
                                labels: this.labels,
                                datasets: [{
                                    label: 'Browser Share',
                                    data: this.data,
                                    backgroundColor: this.colors,
                                    borderColor: '#fff',
                                    borderWidth: 2,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: ctx => `${ctx.label}: ${ctx.formattedValue}%`
                                        }
                                    }
                                }
                            }
                        };
                        if (this.chart !== null) this.chart.destroy()
                        this.chart = new Chart(this.$refs.canvas, config)
                    },
                    init() {
                        this.createChart();
                    },
                    randomize() {
                        this.data = this.data.map(() => Math.floor(Math.random() * 60) + 5)
                        this.createChart();
                    },
                    switchType() {
                        this.type = this.type == 'pie' ? 'doughnut' : 'pie';
                        this.createChart();
                    }
                }
            }
        })
    </script>
</x-layouts.app>