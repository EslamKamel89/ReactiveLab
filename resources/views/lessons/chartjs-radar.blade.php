<x-layouts.app :title="__('Chart.js-Pie')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">

    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.app = () => {
                return {


                }
            }
        })
    </script>
</x-layouts.app>