<x-layouts.app :title="__('Choices')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="choicesApp()">
        <h1 class="text-2xl font-semibold mb-6">Choices.js — Enhanced Select Input</h1>

        <form class="bg-white border border-gray-200 rounded-xl p-4 space-y-4">
            <div>
                <label for="country" class="block text-sm font-medium mb-1">Select a country</label>
                <select x-ref="select" id="country" class="w-full p-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select…</option>
                    <template x-for="option in options" :key="option">
                        <option :value="option" x-text="capitalize(option)"></option>
                    </template>
                </select>
                <p class="mt-1 text-sm text-gray-500">Static select — we’ll enhance it next.</p>
            </div>
        </form>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.choicesApp = () => {
                return {
                    choice: null,
                    value: '',
                    options: [
                        "egypt",
                        "canada",
                        "germany",
                        "japan",
                    ],
                    init() {
                        this.choice = new Choices(this.$refs.choice)
                    }
                }
            }
        })
    </script>
</x-layouts.app>