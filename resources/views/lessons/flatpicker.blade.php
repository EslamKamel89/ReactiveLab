<x-layouts.app :title="__('Users')">
    <section class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl" x-data="datePicker()" x-init="initialize">
        <div class="max-w-xl mx-auto px-4 py-10">
            <h1 class="text-2xl font-semibold mb-6">Flatpickr — Date Picker</h1>

            <!-- Simple form row (static only for now) -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 space-y-3">
                <label class="block text-sm font-medium" for="due-date">Due date</label>
                <input id="due-date" type="text" x-ref="picker"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Select a date" />
                <p class="text-sm text-gray-500">
                    Selected (ISO): <span class="" x-text="pr(value)">hello</span>
                </p>
            </div>
        </div>
    </section>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.datePicker = () => {
                return {
                    fp: null,
                    value: '',
                    initialize() {
                        this.fp = flatpickr(this.$refs.picker, {
                            dateFormat: 'Y-m-d',
                            onChange: (selectedDates, dateStr, instance) => {
                                // console.log(selectedDates, dateStr, instance);
                                if (dateStr) {
                                    this.value = dateStr;
                                    console.log(this.value);
                                }
                            },
                        });
                    }
                }
            }

        })
    </script>
</x-layouts.app>