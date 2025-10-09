<x-layouts.app :title="__('Quill')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">
        <div class="max-w-3xl mx-auto px-4 py-10">
            <h1 class="text-2xl font-semibold mb-6">Chart.js — Bar</h1>

            <!-- Toolbar (static for now) -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center justify-between">
                <div class="font-medium">Monthly Sales</div>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 border rounded">Randomize</button>
                    <button class="px-3 py-1.5 border rounded">Reset</button>
                </div>
            </div>

            <!-- Chart area -->
            <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4">
                <div class="relative">
                    <canvas id="salesChart" class="w-full h-64"></canvas>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.app = () => {
                return {

                }
            }
        })
    </script>
</x-layouts.app>