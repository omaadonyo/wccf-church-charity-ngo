<x-layouts::app :title="__($post ? 'Edit Post' : 'Create Post')">
    @push('head')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <style>
            #quill-editor { height: 400px; }
            #quill-editor .ql-toolbar { border: 1px solid #d4d4d4; border-radius: 0.5rem 0.5rem 0 0; background: #fafafa; }
            #quill-editor .ql-container { border: 1px solid #d4d4d4; border-top: 0; border-radius: 0 0 0.5rem 0.5rem; background: #fff; font-family: 'Lato', ui-sans-serif, system-ui, sans-serif; font-size: 0.875rem; }
            #quill-editor .ql-editor { color: #18181b; min-height: 370px; }
            #quill-editor .ql-editor.ql-blank::before { color: #a3a3a3; font-style: normal; }
            #quill-editor .ql-stroke { stroke: #525252; }
            #quill-editor .ql-fill { fill: #525252; }
            #quill-editor .ql-picker-label { color: #525252; }
            #quill-editor .ql-picker-options { background: #fff; border-color: #d4d4d4; }
            #quill-editor .ql-active .ql-stroke { stroke: #560534; }
            #quill-editor .ql-active .ql-fill { fill: #560534; }
            #quill-editor .ql-picker-item.ql-active { color: #560534; }
            #quill-editor .ql-picker-label.ql-active { color: #560534; }
            #quill-editor .ql-toolbar button:hover .ql-stroke,
            #quill-editor .ql-toolbar button:focus .ql-stroke { stroke: #560534; }
            #quill-editor .ql-toolbar button:hover .ql-fill,
            #quill-editor .ql-toolbar button:focus .ql-fill { fill: #560534; }
            #quill-editor .ql-toolbar button.ql-active .ql-stroke { stroke: #560534; }
            #quill-editor .ql-toolbar button.ql-active .ql-fill { fill: #560534; }

            .dark #quill-editor .ql-toolbar { border-color: #404040; background: #262626; }
            .dark #quill-editor .ql-container { border-color: #404040; border-top: 0; background: #171717; }
            .dark #quill-editor .ql-editor { color: #e4e4e7; }
            .dark #quill-editor .ql-editor.ql-blank::before { color: #71717a; }
            .dark #quill-editor .ql-stroke { stroke: #a3a3a3; }
            .dark #quill-editor .ql-fill { fill: #a3a3a3; }
            .dark #quill-editor .ql-picker-label { color: #a3a3a3; }
            .dark #quill-editor .ql-picker-options { background: #262626; border-color: #404040; color: #e4e4e7; }
            .dark #quill-editor .ql-active .ql-stroke { stroke: #560534; }
            .dark #quill-editor .ql-active .ql-fill { fill: #560534; }
            .dark #quill-editor .ql-picker-item.ql-active { color: #e4e4e7; }
            .dark #quill-editor .ql-picker-label.ql-active { color: #e4e4e7; }

            .media-item { cursor: pointer; transition: all 0.15s; }
            .media-item:hover { border-color: #560534; box-shadow: 0 0 0 2px rgba(86,5,52,0.2); }
            .media-item.selected { border-color: #560534; box-shadow: 0 0 0 2px rgba(86,5,52,0.4); }
            .media-item img { pointer-events: none; }
        </style>
    @endpush

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $post ? 'Edit Post' : 'Create Post' }}</h1>
                <p class="text-sm text-zinc-500 mt-1">{{ $post ? 'Update your blog post.' : 'Write a new blog post.' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Cancel</a>
                <button type="submit" form="blog-form" class="px-5 py-2.5 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">{{ $post ? 'Update Post' : 'Create Post' }}</button>
            </div>
        </div>

        <form method="POST" action="{{ $post ? route('admin.blog.update', $post) : route('admin.blog.store') }}" class="space-y-8" id="blog-form">
            @csrf @if($post) @method('PUT') @endif

            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-2 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Title *</label>
                        <input type="text" name="title" id="post-title" value="{{ old('title', $post->title ?? '') }}" required placeholder="Enter post title" class="w-full px-3 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Slug *</label>
                        <input type="text" name="slug" id="post-slug" value="{{ old('slug', $post->slug ?? '') }}" required placeholder="auto-generated-from-title" class="w-full px-3 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none font-mono text-xs">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Content</label>
                        <div id="quill-editor">{!! old('content', $post->content ?? '') !!}</div>
                        <textarea name="content" id="content-hidden" class="hidden">{{ old('content', $post->content ?? '') }}</textarea>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-5 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Category</label>
                            <select name="blog_category_id" class="w-full px-3 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                                <option value="">— None —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('blog_category_id', $post->blog_category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Featured Image</label>
                            <input type="hidden" name="featured_image_id" id="featured_image_id" value="{{ old('featured_image_id', $post->featured_image_id ?? '') }}">
                            <div id="featured-preview" class="mb-3 {{ old('featured_image_id', $post->featured_image_id ?? '') ? '' : 'hidden' }}">
                                @php $fid = old('featured_image_id', $post->featured_image_id ?? null); $fimg = $fid ? \App\Models\Media::find($fid) : null; @endphp
                                @if($fimg)
                                    <img src="{{ $fimg->url }}" class="w-full aspect-video rounded-lg object-cover border border-zinc-200 dark:border-zinc-700">
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="openMediaModal()" class="flex-1 flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm text-zinc-600 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Browse
                                </button>
                                <button type="button" onclick="clearFeaturedImage()" class="p-2.5 rounded-lg border border-zinc-300 dark:border-zinc-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-zinc-400 hover:text-red-600 transition-colors {{ !old('featured_image_id', $post->featured_image_id ?? '') ? 'hidden' : '' }}" id="clear-featured-btn" title="Remove">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Excerpt</label>
                            <textarea name="excerpt" rows="4" placeholder="Brief summary for listings and previews" class="w-full px-3 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                        </div>
                        <div class="flex items-center gap-2 pt-2 border-t border-zinc-200 dark:border-zinc-700">
                            <input type="hidden" name="published" value="0">
                            <input type="checkbox" name="published" value="1" id="published" @checked(old('published', $post->published ?? false)) class="rounded border-zinc-300 dark:border-zinc-600 text-red-600 focus:ring-red-500">
                            <label for="published" class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Published</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Media Browser Modal --}}
    <div id="media-modal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/50" onclick="closeMediaModal()"></div>
        <div class="absolute inset-4 md:inset-10 bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl flex flex-col overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 flex-shrink-0">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Media Library</h2>
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 px-4 py-2 rounded-lg border border-dashed border-zinc-300 dark:border-zinc-600 text-sm text-zinc-500 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Upload
                        <input type="file" accept="image/*" id="media-upload-input" class="hidden" onchange="uploadMedia(this)">
                    </label>
                    <button onclick="closeMediaModal()" class="p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto p-6">
                <div id="media-grid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                    @foreach($mediaItems as $m)
                        <div class="media-item relative aspect-square rounded-lg overflow-hidden border-2 border-transparent {{ (old('featured_image_id', $post->featured_image_id ?? '') == $m->id) ? 'selected' : '' }}" data-id="{{ $m->id }}" data-url="{{ $m->url }}" onclick="selectMedia(this, {{ $m->id }})">
                            <img src="{{ $m->url }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-1.5">
                                <p class="text-[10px] text-white truncate leading-tight">{{ $m->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-between px-6 py-4 border-t border-zinc-200 dark:border-zinc-700 flex-shrink-0">
                <p class="text-sm text-zinc-500" id="media-selected-info">{{ old('featured_image_id', $post->featured_image_id ?? '') ? '1 image selected' : 'No image selected' }}</p>
                <div class="flex items-center gap-3">
                    <button onclick="closeMediaModal()" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Cancel</button>
                    <button onclick="confirmMediaSelection()" class="px-5 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">Choose</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.min.js"></script>
        <script>
            // ── Quill Editor ──
            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [2, 3, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['blockquote', 'link'],
                        ['clean'],
                    ]
                }
            });

            document.getElementById('blog-form').addEventListener('submit', function() {
                document.getElementById('content-hidden').value = quill.root.innerHTML;
            });

            // ── Auto Slug ──
            const titleInput = document.getElementById('post-title');
            const slugInput = document.getElementById('post-slug');
            let slugManuallyEdited = false;

            function generateSlug(str) {
                return str.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/[\s_]+/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-|-$/g, '');
            }

            titleInput.addEventListener('input', function() {
                if (!slugManuallyEdited) slugInput.value = generateSlug(this.value);
            });

            slugInput.addEventListener('input', function() {
                slugManuallyEdited = this.value !== generateSlug(titleInput.value);
            });

            // Auto-generate on page load if slug is empty (new post)
            if (!slugInput.value) slugInput.value = generateSlug(titleInput.value);

            // ── Media Modal ──
            let selectedMediaId = {{ old('featured_image_id', $post->featured_image_id ?? 'null') }};
            let selectedMediaEl = null;

            function openMediaModal() {
                document.getElementById('media-modal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeMediaModal() {
                document.getElementById('media-modal').classList.add('hidden');
                document.body.style.overflow = '';
            }

            function selectMedia(el, id) {
                document.querySelectorAll('.media-item').forEach(i => i.classList.remove('selected'));
                el.classList.add('selected');
                selectedMediaId = id;
                selectedMediaEl = el;
                document.getElementById('media-selected-info').textContent = '1 image selected';
            }

            function confirmMediaSelection() {
                if (!selectedMediaId) { closeMediaModal(); return; }
                document.getElementById('featured_image_id').value = selectedMediaId;
                const preview = document.getElementById('featured-preview');
                const url = selectedMediaEl ? selectedMediaEl.dataset.url : '';
                preview.innerHTML = url ? `<img src="${url}" class="w-full aspect-video rounded-lg object-cover border border-zinc-200 dark:border-zinc-700">` : '';
                preview.classList.remove('hidden');
                document.getElementById('clear-featured-btn').classList.remove('hidden');
                closeMediaModal();
            }

            function clearFeaturedImage() {
                document.getElementById('featured_image_id').value = '';
                document.getElementById('featured-preview').innerHTML = '';
                document.getElementById('featured-preview').classList.add('hidden');
                document.getElementById('clear-featured-btn').classList.add('hidden');
                selectedMediaId = null;
                selectedMediaEl = null;
                document.querySelectorAll('.media-item').forEach(i => i.classList.remove('selected'));
            }

            function uploadMedia(input) {
                const file = input.files[0];
                if (!file) return;
                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', '{{ csrf_token() }}');
                fetch('{{ route('admin.media.upload') }}', { method: 'POST', body: formData })
                    .then(r => { input.value = ''; refreshMediaGrid(); });
            }

            function refreshMediaGrid() {
                fetch('{{ route('admin.media.json') }}')
                    .then(r => r.json())
                    .then(data => {
                        document.getElementById('media-grid').innerHTML = data.map(m => `
                            <div class="media-item relative aspect-square rounded-lg overflow-hidden border-2 border-transparent" data-id="${m.id}" data-url="${m.url}" onclick="selectMedia(this, ${m.id})">
                                <img src="${m.url}" alt="${m.name}" class="w-full h-full object-cover">
                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-1.5">
                                    <p class="text-[10px] text-white truncate leading-tight">${m.name}</p>
                                </div>
                            </div>
                        `).join('');
                    });
            }
        </script>
    @endpush
</x-layouts::app>
