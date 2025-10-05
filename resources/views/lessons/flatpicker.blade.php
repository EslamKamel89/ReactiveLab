<x-layouts.app :title="__('Flatpickr')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="datePicker()" x-init="initialize">
        <div class="max-w-xl w-full mx-auto px-4 ">
            <h1 class="text-2xl font-semibold mb-6">Flatpickr — Date Picker</h1>

            <!-- Simple form row (static only for now) -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 space-y-3">
                <label class="block text-sm font-medium" for="due-date">Due date</label>
                <input id="due-date" type="text" x-ref="picker"
                    class="w-full rounded-lg p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Select a date" />
                <button type="button" class="px-3 py-2 rounded-lg border"
                    @click="value = (new Date()).toISOString().slice(0,10)">Today</button>
                <button type="button" class="px-3 py-2 rounded-lg border"
                    @click="value = ''">Clear</button>
                <p class="text-sm text-gray-500">
                    Selected (ISO): <span class="" x-text="value">hello</span>
                </p>
            </div>
        </div>
    </section>
    <section class="flex  w-full  flex-col gap-4 rounded-xl" x-data="dateRange()">
        <div class="max-w-xl w-full mx-auto p-4 bg-white border border-gray-200 rounded-xl  space-y-3">
            <label class="block text-sm font-medium" for="range">Date range</label>
            <input id="range" type="text" x-ref="range"
                class="w-full p-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Select a date range" />
            <p class="text-sm text-gray-500">
                Start: <span class="font-mono" x-text="start || '—'"></span> |
                End: <span class="font-mono" x-text="end || '—'"></span>
            </p>
        </div>
    </section>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            window.datePicker = () => {
                return {
                    fp: null,
                    value: '',
                    initialize() {
                        this.fp = flatpickr(this.$refs.picker, {
                            dateFormat: 'Y-m-d',
                            altInput: true,
                            altFormat: 'F j, Y',
                            onChange: (selectedDates, dateStr, instance) => {
                                // console.log(selectedDates, dateStr, instance);
                                if (dateStr) {
                                    this.value = dateStr;
                                    console.log(this.value);
                                }
                            },
                        });
                        this.$watch('value', (val) => {
                            this.fp.setDate(val || null, true)
                        })
                    }
                }
            }
            window.dateRange = () => {
                return {
                    fp: null,
                    start: null,
                    end: null,
                    init() {
                        this.fb = flatpickr(this.$refs.range, {
                            mode: 'range',
                            dateFormat: 'Y-m-d',
                            altInput: true,
                            altFormat: 'F j, Y',
                            // inline: true,
                            onChange: (_, val) => {
                                let range = val.split('to')
                                if (range.length != 2) return;
                                range = range.map((r) => r.trim());
                                [this.start, this.end] = range;
                            }

                        });
                    }

                }
            };
        })
    </script>
</x-layouts.app>