<x-layouts.app :title="__('Choices')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="choicesApp()">
        <h1 class="text-2xl font-semibold mb-6">Choices.js — Enhanced Select Input</h1>

        <form class="bg-white border border-gray-200 rounded-xl p-4 space-y-4">
            <div>
                <label for="country" class="block text-sm font-medium mb-1">Select a country</label>
                <select x-ref="select" id="country" class="w-full p-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="egypt">Egypt</option>
                    <option value="canada">Canada</option>
                    <option value="germany">Germany</option>
                    <option value="japan">Japan</option>
                </select>
                <p x-show="value" class="mt-1 text-sm text-gray-500">Static select — <span x-text="value"></span></p>
            </div>
        </form>
    </section>

    <script src="
https://cdn.jsdelivr.net/npm/choices.js@11.1.0/public/assets/scripts/choices.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/choices.js@11.1.0/public/assets/styles/choices.min.css
" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.choicesApp = () => {
                return {
                    choice: null,
                    value: '',
                    init() {
                        this.choice = new Choices(this.$refs.select, {
                            searchEnabled: true,
                            itemSelectText: '',
                            placeholderValue: 'Select country...',
                        })
                        this.$refs.select.addEventListener('change', (e) => {
                            this.value = e.detail.value;
                        })
                    }
                }
            }
        })
    </script>
</x-layouts.app>