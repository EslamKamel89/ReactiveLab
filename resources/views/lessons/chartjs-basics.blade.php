<x-layouts.app :title="__('Quill')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">
        <div>chart js</div>
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