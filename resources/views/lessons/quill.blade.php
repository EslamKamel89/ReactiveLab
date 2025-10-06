<x-layouts.app :title="__('Quill')">
    <section class="flex  w-full my-3  flex-col gap-4 rounded-xl" x-data="app()">
        <div class="max-w-2xl mx-auto px-4 py-10">
            <h1 class="text-2xl font-semibold mb-6">Quill.js — Rich Text Editor</h1>

            <form class="bg-white border border-gray-200 rounded-xl p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Article Body</label>
                    <input type="hidden" :value="content">
                    <div x-ref="quill" class="h-48 border border-gray-300 rounded-lg p-2" id="editor">
                    </div>
                    <p x-html="content"></p>
                    <button type="button" @click="content = 'hello'" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        say hello
                    </button>
                </div>

                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                    Submit
                </button>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.app = () => {
                return {
                    quill: null,
                    content: '',
                    init() {
                        this.quill = new Quill(this.$refs.quill, {
                            modules: {
                                toolbar: [
                                    ['bold', 'italic'],
                                    ['link', 'blockquote', 'code-block', 'image'],
                                    [{
                                        list: 'ordered'
                                    }, {
                                        list: 'bullet'
                                    }],
                                ],
                            },
                            theme: 'snow',
                        });
                        this.quill.on('text-change', (delta, oldDelta, source) => {
                            this.content = this.quill.root.innerHTML;
                        })
                        this.$watch('content', (content) => {
                            console.log(content);
                            this.quill.root.innerHTML = content
                        })
                    }
                }
            }
        })
    </script>
</x-layouts.app>