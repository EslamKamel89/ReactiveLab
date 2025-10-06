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
                <div class="flex gap-2 pt-2">
                    <button
                        type="button"
                        class="px-3 py-1.5 border rounded"
                        @click="value='canada'">
                        Select Canada
                    </button>
                    <button type="button" class="px-3 py-1.5 border rounded" @click="value=''">
                        Clear
                    </button>
                </div>
            </div>
            <div>
                <label for="multi" class="block text-sm font-medium mb-1">Select a framework</label>
                <select x-ref="multi" id="multi" multiple>
                    <option value="vue">Vue</option>
                    <option value="react">React</option>
                    <option value="alpine">Alpine</option>
                    <option value="svelte">Svelte</option>
                </select>

                <p class="block text-sm font-medium mb-1" x-show="values.length">You selected</p>
                <ul class="flex flex-wrap space-x-3">
                    <template x-for="value in values" :key=value>
                        <li x-text="value" class="bg-blue-500 rounded-2xl py-1 px-2 text-white"></li>
                    </template>
                </ul>
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
                    multi: null,
                    value: '',
                    values: [],
                    init() {
                        this.choice = new Choices(this.$refs.select, {
                            searchEnabled: true,
                            itemSelectText: '',
                            placeholderValue: 'Select country...',
                        })
                        this.$refs.select.addEventListener('change', (e) => {
                            this.value = e.detail.value;
                        })
                        this.$watch('value', (value) => {
                            // this.choice.clearStore();
                            // if (value)
                            this.choice.setChoiceByValue(value);
                        })
                        this.multi = new Choices(this.$refs.multi, {
                            removeItemButton: true,
                        })
                        this.$refs.multi.addEventListener('change', (e) => {
                            this.values = Array.from(e.target.selectedOptions).map((o) => o.innerText)
                        })
                    }
                }
            }
        })
    </script>
</x-layouts.app>