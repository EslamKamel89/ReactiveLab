<x-layouts.app :title="__('Users')">
    <section class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="max-w-5xl mx-auto px-4 py-8">
            <h1 class="text-2xl font-semibold mb-6">Users Directory</h1>

            <!-- Toolbar -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <div class="flex-1">
                    <input type="text" placeholder="Search users..."
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1.5 rounded-lg border border-gray-200 bg-white">Refresh</button>
                </div>
            </div>

            <!-- List -->
            <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @for ($i = 0; $i < 6; $i++)
                    <article class="bg-white border border-gray-200 rounded-xl p-4">
                    <div class="h-4 w-28 bg-gray-200 rounded mb-2"></div>
                    <div class="h-3 w-40 bg-gray-200 rounded"></div>
                    </article>
                    @endfor
            </div>

            <!-- Footer / Pagination -->
            <div class="mt-6 flex items-center justify-between text-sm text-gray-600">
                <div>Page 1 of 1</div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1.5 rounded-lg border border-gray-200 bg-white">Prev</button>
                    <button class="px-3 py-1.5 rounded-lg border border-gray-200 bg-white">Next</button>
                </div>
            </div>
        </div>
    </section>
    </div>
    <script>
        function usersPage() {
            return {
                users: [],
                meta: {
                    page: 1,
                    last_page: 1,
                    total: 0
                },
                page: 1,
                search: '',
                loading: false,
                error: '',
                controller: null,
                init() {
                    this.fetchList()
                }
            }
        }
    </script>
</x-layouts.app>