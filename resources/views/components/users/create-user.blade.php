<div
    class="fixed inset-0 z-50"
    x-data="createUser()"
    x-show="show"
    x-transition.duration.500ms
    @open-create-user-drawer.window="openDrawer()"
    @click.outside="closeDrawer()">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/40" @click="closeDrawer()"></div>

    <!-- Panel -->
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white border-l border-gray-200 shadow p-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">New User</h2>
            <button class="px-3 py-1.5 rounded border" @click="closeDrawer()">✕</button>
        </div>

        <form class="mt-4 space-y-4" @submit.prevent="submit">
            <div>
                <label class="block text-sm font-medium mb-1">Full name</label>
                <input x-model="form.name" type="text" class="p-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Jane Doe">
                <p class="mt-1 text-xs text-rose-600" x-text="errors.name"> </p>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input x-model="form.email" type="email" class="p-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="jane@example.com">
                <p class="mt-1 text-xs text-rose-600" x-text="errors.email"></p>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input x-model="form.password" type="password" class="p-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="jane@example.com">
                <p class="mt-1 text-xs text-rose-600" x-text="errors.password"></p>
            </div>
            <fieldset>
                <legend class="block text-sm font-medium mb-1">Role</legend>
                <div class="flex items-center gap-6 text-sm">
                    <label class="inline-flex items-center gap-2">
                        <input x-model="form.role" type="radio" name="role" value="admin" class="p-2 text-indigo-600 border-gray-300">
                        <span>Admin</span>
                    </label>
                    <label class="inline-flex items-center gap-2">
                        <input x-model="form.role" type="radio" name="role" value="user" class="p-2 text-indigo-600 border-gray-300" checked>
                        <span>User</span>
                    </label>
                </div>
                <p class="mt-1 text-xs text-rose-600 " x-model="errors.role"></p>
            </fieldset>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" class="px-4 py-2 rounded-lg border" @click="closeDrawer()">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const axios = window.axios;
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
        window.createUser = () => {
            return {
                show: false,
                openDrawer() {
                    this.show = true;
                },
                closeDrawer() {
                    this.show = false;
                    this.resetErrors();
                },
                loading: false,
                form: {
                    name: '',
                    email: '',
                    password: '',
                    role: 'user'
                },
                errors: {
                    name: '',
                    email: '',
                    password: '',
                    role: ''
                },
                resetErrors() {
                    this.errors = {
                        name: '',
                        email: '',
                        password: '',
                        role: ''
                    };
                },
                controller: null,
                async submit() {
                    this.loading = true;
                    this.resetErrors();
                    this.controller?.abort();
                    this.controller = new AbortController();
                    try {
                        const {
                            data,
                            status
                        } = await axios.post('/api/users', this.form, {
                            signal: this.controller.signal,
                        });
                        if (status == 200 || status == 201) {
                            console.log(data)
                        }
                    } catch (error) {
                        const errors = error?.response?.data?.errors;
                        if (!errors) {
                            console.error('Unknown error occurred')
                        }
                        this.errors = {
                            name: errors.name?.length ? errors.name[0] : '',
                            email: errors.email?.length ? errors.email[0] : '',
                            password: errors.password?.length ? errors.password[0] : '',
                            role: errors.role?.length ? errors.role[0] : ''

                        }
                        console.log(this.errors);
                    }
                },
                init() {
                    this.$watch('form', () => {
                        console.log(this.form);
                    })
                }
            }
        }
    })
</script>