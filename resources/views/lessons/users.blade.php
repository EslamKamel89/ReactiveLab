<x-layouts.app :title="__('Users')">
    <section class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl" x-data="usersPage()">
        <div class="max-w-5xl mx-auto px-4 py-8">
            <div class="flex w-full justify-between">
                <h1 class="text-2xl font-semibold mb-6">Users Directory</h1>
                <flux:button icon="plus" @click="$dispatch('open-create-user-drawer')">
                    Create User
                </flux:button>
            </div>

            <!-- Toolbar -->
            <div class="bg-white border border-gray-200 rounded-xl p-2 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                <div class="flex-1">
                    <input type="text" placeholder="Search users..."
                        x-model.debounce="search"
                        class="w-full rounded-lg border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500" />
                </div>
                <div class="flex items-center gap-2">
                    <button @click="fetchList(search)" class="px-3 py-1.5 rounded-lg border border-gray-200 bg-white">Refresh</button>
                </div>
            </div>
            <div x-show="error" class="mt-4 rounded-lg border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3 text-sm">
                <span x-text="error"></span>
            </div>
            <!-- List -->
            <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <template x-if="loading && !users.length">
                    <template x-for="i in 6" :key="i">
                        <article class="bg-white border border-gray-200 rounded-xl p-4">
                            <div class="h-4 w-28 bg-gray-200 rounded mb-2"></div>
                            <div class="h-3 w-40 bg-gray-200 rounded"></div>
                        </article>
                    </template>
                </template>
                <template x-if="!loading && users.length">
                    <template x-for="user in users" :key="user.id">
                        <article class="bg-white border border-gray-200 rounded-xl p-4">
                            <div class="h-4  rounded mb-2" x-text="user.name"></div>
                            <div class="h-3  rounded text-xs text-muted" x-text="user.email"></div>
                            <div class="flex w-full justify-end">
                                <flux:badge color="lime" class="mt-2"> <span x-text="user.role"></span> </flux:badge>
                            </div>
                        </article>
                    </template>
                </template>
                <template x-if="!loading && !users.length && !error">
                    <div class="sm:col-span-2 lg:col-span-3 text-sm text-gray-500">No users found.</div>
                </template>
            </div>

            <!-- Footer / Pagination -->
            <div class="mt-6 flex items-center justify-between text-sm text-gray-600">
                <div>Page <span x-text="page"></span> of <span x-text="total"></span></div>
                <div class="flex items-center gap-2">
                    <button :disabled="page <= 1 || loading" @click="page--;fetchList()" class="px-3 py-1.5 rounded-lg border border-gray-200 bg-white cursor-pointer disabled:cursor-not-allowed">Prev</button>
                    <button x-bind:disabled="page >= total || loading" @click="page++;fetchList()" class="px-3 py-1.5 rounded-lg border border-gray-200 bg-white cursor-pointer disabled:cursor-not-allowed">Next</button>
                </div>
            </div>
            <!-- Drawer (hidden by default; will slide in from the right) -->
            <x-users.create-user />
        </div>
    </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const axios = window.axios;
            window.usersPage = () => {
                return {
                    users: [],

                    page: 1,
                    last_page: 1,
                    total: 0,
                    search: '',
                    loading: false,
                    error: '',
                    controller: null,
                    async fetchList(search) {
                        this.error = '';
                        this.loading = true;
                        this.controller = new AbortController();
                        try {
                            const {
                                data
                            } = await axios.get('/api/users', {
                                params: {
                                    search: search,
                                    page: this.page,
                                },
                                signal: this.controller.signal,
                            })
                            this.users = data.data;

                            this.page = data.current_page;
                            this.last_page = data.last_page;
                            this.total = data.total;

                        } catch (e) {
                            if (e.name == 'CancelError' || e.code == 'ERR_CANCELED') return;
                            this.error = e?.response?.data?.message || e.message || 'Request failed';
                            console.error(this.error);
                        } finally {
                            this.loading = false;
                        }

                    },
                    init() {
                        this.fetchList(this.search);
                        this.$watch('search', (search) => {
                            this.page = 1;
                            this.fetchList(search);
                        })
                    }
                }
            }

        });
        // axios.defaults.baseURL = '/api';
        // axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    </script>
</x-layouts.app>