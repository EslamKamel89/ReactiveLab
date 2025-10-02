<div
    class="fixed inset-0 z-50"
    x-data="createUser()"
    x-show="show"
    x-transition.duration.500ms
    @open-create-user-drawer.window="show=true"
    @click.outside="show=false">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/40" @click="show=false"></div>

    <!-- Panel -->
    <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white border-l border-gray-200 shadow p-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">New User</h2>
            <button class="px-3 py-1.5 rounded border" @click="show=false">✕</button>
        </div>

        <form class="mt-4 space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Full name</label>
                <input type="text" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Jane Doe">
                <p class="mt-1 text-xs text-rose-600 hidden">Error message</p>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="jane@example.com">
                <p class="mt-1 text-xs text-rose-600 hidden">Error message</p>
            </div>
            <fieldset>
                <legend class="block text-sm font-medium mb-1">Role</legend>
                <div class="flex items-center gap-6 text-sm">
                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="role" value="admin" class="text-indigo-600 border-gray-300">
                        <span>Admin</span>
                    </label>
                    <label class="inline-flex items-center gap-2">
                        <input type="radio" name="role" value="user" class="text-indigo-600 border-gray-300" checked>
                        <span>User</span>
                    </label>
                </div>
                <p class="mt-1 text-xs text-rose-600 hidden">Error message</p>
            </fieldset>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" class="px-4 py-2 rounded-lg border">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.createUser = () => {
            return {
                show: false
            }
        }
    })
</script>