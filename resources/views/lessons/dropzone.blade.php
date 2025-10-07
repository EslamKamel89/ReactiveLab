<x-layouts.app :title="__('Quill')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">
        <div class="max-w-2xl mx-auto px-4 py-10">
            <h1 class="text-2xl font-semibold mb-6">Dropzone.js — Drag & Drop Uploads</h1>

            <form class="bg-white border border-gray-200 rounded-xl p-6 space-y-4" x-ref="dropzone">
                <div class="flex flex-col space-y-2 w-full">
                    <input type="email" class="p-2 rounded" name="username" />
                    <input type="password" class="p-2 rounded" name="password" />
                </div>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center text-gray-500">
                    <p class="font-medium">Drag files here or click to upload</p>
                </div>
            </form>
            <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Files List (Alpine State)</h3>
                <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                    <template x-for="file in files" :key="file.name">
                        <li x-text="`${file.name} (${Math.round(file.size/1024)} KB)`"></li>
                    </template>
                    <template x-if="files.length === 0">
                        <li>No files yet.</li>
                    </template>
                </ul>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.app = () => {
                return {
                    dz: null,
                    files: [],
                    init() {
                        Dropzone.autoDiscover = false;
                        this.dz = new Dropzone(this.$refs.dropzone, {
                            url: '/example.com',
                            maxFiles: 3,
                            acceptedFiles: 'image/*',
                            addRemoveLinks: true,
                            autoProcessQueue: false,
                        });
                        this.dz.on('addedfile', (file) => {
                            console.log(file);
                            this.files.push(file)
                        })
                        this.dz.on('removedfile', (file) => {
                            this.files = this.files.filter((f) => f.name !== file.name);
                        })

                    }
                }
            }
        })
    </script>
</x-layouts.app>