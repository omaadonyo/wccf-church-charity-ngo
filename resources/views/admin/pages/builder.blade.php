<x-layouts::app :title="__('Page Builder: ' . $page->title)">
    <style>
        [data-flux-main] { padding: 0 !important; min-height: 0 !important; height: 100% !important; }
        #editor-content input:where([type="text"],[type="url"],[type="number"]),
        #editor-content textarea,
        #editor-content select { color: inherit; }
        .dark #editor-content input:where([type="text"],[type="url"],[type="number"]),
        .dark #editor-content textarea,
        .dark #editor-content select { color: #e4e4e7; }
        .dark #editor-content input:where([type="text"],[type="url"],[type="number"])::placeholder,
        .dark #editor-content textarea::placeholder { color: #71717a; }
        .media-item { cursor: pointer; transition: all 0.15s; }
        .media-item:hover { border-color: #560534; box-shadow: 0 0 0 2px rgba(86,5,52,0.2); }
        .media-item.selected { border-color: #560534; box-shadow: 0 0 0 2px rgba(86,5,52,0.4); }
        .media-item img { pointer-events: none; }
    </style>
    <script>document.documentElement.style.overflow='hidden';document.body.style.overflow='hidden';document.body.style.height='100vh';document.body.style.minHeight='0';</script>
    <div class="flex min-h-0 w-full flex-1 flex-col rounded-t-xl" style="height:100%">
        {{-- Top bar --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 rounded-t-xl">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.pages.index') }}" class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300">&larr; Pages</a>
                <div>
                    <h1 class="text-lg font-bold text-zinc-900 dark:text-white">{{ $page->title }}</h1>
                    <p class="text-xs text-zinc-500">/<span class="font-mono">{{ $page->slug }}</span></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span id="save-status" class="text-xs text-zinc-400">All changes saved</span>
                <button onclick="saveSections()" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary-dark transition-colors">Save</button>
                <a href="{{ route('admin.pages.edit', $page) }}" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Settings</a>
            </div>
        </div>

        <div class="flex flex-1" style="min-height:0">
            {{-- Section palette --}}
            <div class="w-64 border-e border-neutral-200 dark:border-neutral-700 bg-zinc-50 dark:bg-zinc-900 p-4 overflow-y-auto flex-shrink-0 hidden lg:block">
                <h3 class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-3">Add Section</h3>
                <div class="space-y-1.5" id="section-palette">
                    @php
                        $sectionTypes = [
                            ['type' => 'hero', 'label' => 'Hero Banner', 'icon' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z'],
                            ['type' => 'text_block', 'label' => 'Text Block', 'icon' => 'M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z'],
                            ['type' => 'image', 'label' => 'Image', 'icon' => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z'],
                            ['type' => 'gallery', 'label' => 'Gallery', 'icon' => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z'],
                            ['type' => 'video', 'label' => 'Video', 'icon' => 'M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z'],
                            ['type' => 'stats', 'label' => 'Stats Bar', 'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z'],
                            ['type' => 'cta', 'label' => 'Call to Action', 'icon' => 'M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z'],
                            ['type' => 'values', 'label' => 'Core Values', 'icon' => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z'],
                            ['type' => 'two_column', 'label' => 'Two Columns', 'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'],
                            ['type' => 'hero_slider', 'label' => 'Hero Slider', 'icon' => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z'],
                            ['type' => 'vision_mission', 'label' => 'Vision & Mission', 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z'],
                            ['type' => 'recent_posts', 'label' => 'Recent Posts', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                            ['type' => 'team', 'label' => 'Team Members', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
                            ['type' => 'volunteer_form', 'label' => 'Volunteer / Membership Form', 'icon' => 'M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z'],
                        ];
                    @endphp
                    @foreach($sectionTypes as $st)
                        <button onclick="addSection('{{ $st['type'] }}')" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-zinc-600 dark:text-zinc-400 hover:bg-white dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white transition-colors text-start">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $st['icon'] }}"/></svg>
                            {{ $st['label'] }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Builder canvas --}}
            <div class="flex-1 overflow-y-auto bg-zinc-100 dark:bg-zinc-950 p-6" id="builder-canvas">
                <div class="max-w-3xl mx-auto space-y-4" id="sections-container">
                    {{-- Sections rendered by JS --}}
                </div>
            </div>

            {{-- Section editor sidebar --}}
            <div class="w-96 border-s border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-y-auto flex-shrink-0 hidden lg:block" id="editor-sidebar">
                <div class="p-6">
                    <h3 class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-1">Section Editor</h3>
                    <p class="text-xs text-zinc-400 mb-4">Click a section to edit its content</p>
                    <div id="editor-content">
                        <p class="text-xs text-zinc-400 text-center py-8">Click a section on the canvas to edit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- SortableJS --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
    <script>
    // ─── Upload Helpers ────────────────────────────────────────────────────
    const UPLOAD_URL = '{{ route('admin.media.upload') }}';
    const CSRF_TOKEN = '{{ csrf_token() }}';

    function uploadFile(inputEl, sectionId) {
        const file = inputEl.files?.[0];
        if (!file) return;
        const fd = new FormData();
        fd.append('file', file);
        fd.append('_token', CSRF_TOKEN);
        inputEl.disabled = true;
        fetch(UPLOAD_URL, { method: 'POST', body: fd })
            .then(r => r.json())
            .then(data => {
                inputEl.disabled = false;
                if (data.url) {
                    updateSectionData(sectionId, 'video_url', data.url);
                    renderSection(sectionId);
                }
            })
            .catch(() => { inputEl.disabled = false; });
    }

    function uploadImage(inputEl, callback) {
        const file = inputEl.files?.[0];
        if (!file) return;
        const fd = new FormData();
        fd.append('file', file);
        fd.append('_token', CSRF_TOKEN);
        inputEl.disabled = true;
        inputEl.nextElementSibling.textContent = 'Uploading...';
        fetch(UPLOAD_URL, { method: 'POST', body: fd })
            .then(r => r.text())
            .then(() => {
                // Re-fetch the media page HTML to extract the newly uploaded URL
                // Simple approach: rebuild the media list snippet
                fetch('{{ route('admin.media.index') }}')
                    .then(r => r.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        // Find most recent media file URL from the listing
                        const urlEls = doc.querySelectorAll('[class*="font-mono"][class*="truncate"]');
                        let lastUrl = '';
                        urlEls.forEach(el => {
                            const t = el.textContent.trim();
                            if (t.startsWith('/storage/')) lastUrl = t;
                        });
                        // Fallback: construct from filename
                        const url = lastUrl || '/storage/media/' + file.name;
                        inputEl.disabled = false;
                        inputEl.nextElementSibling.textContent = 'Upload';
                        if (callback) callback(url);
                    });
            })
            .catch(() => {
                inputEl.disabled = false;
                inputEl.nextElementSibling.textContent = 'Upload';
                alert('Upload failed');
            });
    }

    // ─── Heading formatting helpers ────────────────────────────────────────
    function stripHtml(str) { return str ? String(str).replace(/<[^>]+>/g, '') : ''; }

    function headingEditor(id, fieldKey, value) {
        const plain = stripHtml(value);
        return `<div class="flex items-start gap-1">
            <input type="text" value="${esc(plain)}" placeholder="Heading"
                onchange="updateSectionData('${id}','${fieldKey}',this.value)"
                class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
            <div class="flex gap-0.5 flex-shrink-0 mt-0.5">
                <button type="button" onclick="highlightLastWord('${id}','${fieldKey}')"
                    class="w-7 h-7 flex items-center justify-center rounded text-xs font-bold bg-primary/10 text-primary hover:bg-primary/20 border border-primary/20" title="Highlight last word in red">R</button>
                <button type="button" onclick="clearFormatting('${id}','${fieldKey}')"
                    class="w-7 h-7 flex items-center justify-center rounded text-xs bg-zinc-100 text-zinc-500 hover:bg-zinc-200 border border-zinc-200" title="Remove formatting">🗙</button>
            </div>
        </div>`;
    }

    function highlightLastWord(id, key) {
        const section = sections.find(s => s.id === id);
        if (!section) return;
        const plain = stripHtml(section.data[key]);
        const words = plain.split(' ');
        if (words.length === 0 || !words[words.length-1]) return;
        const last = words.pop();
        words.push('<span class="text-red">' + last + '</span>');
        section.data[key] = words.join(' ');
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }

    function clearFormatting(id, key) {
        const section = sections.find(s => s.id === id);
        if (!section) return;
        section.data[key] = stripHtml(section.data[key]);
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }
    // ───────────────────────────────────────────────────────────────────────

    // Reusable image browse — opens media modal
    function imgUploadHtml(id, dataKey, slideIndex) {
        const setUrl = slideIndex !== undefined
            ? `updateSlide('${id}',${slideIndex},'image',url);renderSections();renderEditor('${id}')`
            : `updateSectionData('${id}','${dataKey}',url);renderSections();renderEditor('${id}')`;
        return `<div class="mt-1">
            <button type="button" onclick="openMediaModal(function(url){${setUrl}})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-xs font-medium text-zinc-600 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 cursor-pointer transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Browse Media
            </button>
        </div>`;
    }

    // Gallery helpers
    function updateGalleryImage(id, index, value) {
        const section = sections.find(s => s.id === id);
        if (!section || !section.data.images) return;
        section.data.images[index] = value;
        dirty = true;
        renderSections();
        updateSaveStatus();
    }

    function removeGalleryImage(id, index) {
        const section = sections.find(s => s.id === id);
        if (!section || !section.data.images) return;
        section.data.images.splice(index, 1);
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }

    // Hero slider helpers
    function addSlide(id) {
        const section = sections.find(s => s.id === id);
        if (!section) return;
        if (!section.data.slides) section.data.slides = [];
        section.data.slides.push({ title: '', subtitle: '', image: '' });
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }

    function removeSlide(id, index) {
        const section = sections.find(s => s.id === id);
        if (!section || !section.data.slides) return;
        section.data.slides.splice(index, 1);
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }

    function updateSlide(id, index, key, value) {
        const section = sections.find(s => s.id === id);
        if (!section || !section.data.slides || !section.data.slides[index]) return;
        section.data.slides[index][key] = value;
        dirty = true;
        renderSections();
        updateSaveStatus();
    }

    // Team members helpers
    function addMember(id) {
        const section = sections.find(s => s.id === id);
        if (!section) return;
        if (!section.data.items) section.data.items = [];
        section.data.items.push({ name: '', role: '', photo: '', bio: '' });
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }

    function removeMember(id, index) {
        const section = sections.find(s => s.id === id);
        if (!section || !section.data.items) return;
        section.data.items.splice(index, 1);
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }

    function updateMember(id, index, key, value) {
        const section = sections.find(s => s.id === id);
        if (!section || !section.data.items || !section.data.items[index]) return;
        section.data.items[index][key] = value;
        dirty = true;
        renderSections();
        renderEditor(id);
        updateSaveStatus();
    }

    // ────────────────────────────────────────────────────────────────────────

    // Section type definitions
    const SECTION_TYPES = {
        hero: {
            label: 'Hero Banner',
            defaultData: { title: 'Hero Title', subtitle: 'Hero subtitle goes here', image: '', overlay: true },
            render: (d) => `<div class="relative h-64 bg-gradient-to-br from-zinc-800 to-zinc-900 rounded-xl flex items-center justify-center text-white overflow-hidden">
                ${d.image ? `<img src="${d.image}" class="absolute inset-0 w-full h-full object-cover opacity-40">` : ''}
                <div class="relative text-center p-8"><h2 class="text-2xl font-bold mb-2">${esc(d.title)}</h2><p class="text-sm opacity-80">${esc(d.subtitle)}</p></div>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Title</label><input type="text" value="${esc(d.title)}" onchange="updateSectionData('${id}','title',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Subtitle</label><textarea rows="2" onchange="updateSectionData('${id}','subtitle',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.subtitle)}</textarea></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Background Image</label>
                    <div class="flex items-center gap-2"><input type="text" value="${esc(d.image || '')}" placeholder="Image URL" onchange="updateSectionData('${id}','image',this.value)" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${imgUploadHtml(id, 'image')}
                        ${d.image ? `<button onclick="updateSectionData('${id}','image','');renderSections();renderEditor('${id}')" class="p-1.5 rounded hover:bg-primary/10 dark:hover:bg-primary/20 text-zinc-400 hover:text-primary" title="Remove image"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>` : ''}
                    </div>
                    ${d.image ? `<img src="${esc(d.image)}" class="h-16 rounded object-cover mt-1">` : ''}
                </div>
            </div>`
        },
        text_block: {
            label: 'Text Block',
            defaultData: { heading: 'Section Heading', content: 'Content goes here. Edit this text in the editor panel.' },
            render: (d) => `<div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-700">
                ${d.heading ? `<h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-3">${esc(d.heading)}</h3>` : ''}
                <p class="text-zinc-600 dark:text-zinc-400 text-sm leading-relaxed">${esc(d.content)}</p>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Content</label><textarea rows="6" onchange="updateSectionData('${id}','content',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.content)}</textarea></div>
            </div>`
        },
        image: {
            label: 'Image',
            defaultData: { src: 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=800&q=80', caption: 'Image caption', alt: '' },
            render: (d) => `<div class="bg-white dark:bg-zinc-800 rounded-xl overflow-hidden shadow-sm border border-zinc-200 dark:border-zinc-700">
                <img src="${esc(d.src)}" alt="${esc(d.alt || '')}" class="w-full h-64 object-cover">
                ${d.caption ? `<p class="text-xs text-zinc-500 dark:text-zinc-400 text-center py-2 px-4">${esc(d.caption)}</p>` : ''}
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Image</label>
                    <div class="flex items-center gap-2"><input type="text" value="${esc(d.src)}" placeholder="Image URL" onchange="updateSectionData('${id}','src',this.value)" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${imgUploadHtml(id, 'src')}
                        ${d.src ? `<button onclick="updateSectionData('${id}','src','');renderSections();renderEditor('${id}')" class="p-1.5 rounded hover:bg-primary/10 dark:hover:bg-primary/20 text-zinc-400 hover:text-primary" title="Remove image"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>` : ''}
                    </div>
                    ${d.src ? `<img src="${esc(d.src)}" class="h-20 rounded object-cover mt-1">` : ''}
                </div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Caption</label><input type="text" value="${esc(d.caption || '')}" onchange="updateSectionData('${id}','caption',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Alt Text</label><input type="text" value="${esc(d.alt || '')}" onchange="updateSectionData('${id}','alt',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
            </div>`
        },
        gallery: {
            label: 'Gallery',
            defaultData: { images: [
                'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=400&q=80',
                'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=400&q=80',
                'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=400&q=80',
            ]},
            render: (d) => `<div class="grid grid-cols-3 gap-2 rounded-xl overflow-hidden">
                ${(d.images || []).slice(0, 6).map(src => `<img src="${esc(src)}" class="h-32 w-full object-cover">`).join('')}
            </div>`,
            editor: (d, id) => `<div class="space-y-3">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Subtitle</label><input type="text" value="${esc(d.subtitle || '')}" onchange="updateSectionData('${id}','subtitle',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <label class="block text-xs font-medium text-zinc-500 mb-1">Images</label>
                <div id="gallery-list-${id}" class="space-y-2">
                    ${(d.images || []).map((src, i) => `<div class="flex items-center gap-2">
                        <img src="${esc(src)}" class="h-10 w-10 object-cover rounded flex-shrink-0">
                        <input type="text" value="${esc(src)}" onchange="updateGalleryImage('${id}',${i},this.value)" class="flex-1 px-2 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-xs font-mono">
                        <button onclick="removeGalleryImage('${id}',${i})" class="p-1 rounded hover:bg-primary/10 dark:hover:bg-primary/20 text-zinc-400 hover:text-primary flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>`).join('')}
                </div>
                <div class="mt-2">
                    <button type="button" onclick="openMediaModal(function(url){const imgs=d.images||[];imgs.push(url);updateSectionData('${id}','images',imgs);renderSections();renderEditor('${id}')})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md border border-dashed border-zinc-300 dark:border-zinc-600 text-xs font-medium text-zinc-500 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-700 cursor-pointer transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Browse Media
                    </button>
                </div>
            </div>`
        },
        video: {
            label: 'Video',
            defaultData: { source_type: 'youtube', youtube_url: 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', caption: 'Watch our story' },
            render: (d) => {
                const isYt = (d.source_type || 'youtube') === 'youtube';
                const url = isYt ? (d.youtube_url || d.url || '') : (d.video_url || '');
                const ytId = isYt ? (url.match(/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([\w-]{11})/) || [])[1] : null;
                const embedSrc = ytId ? 'https://www.youtube.com/embed/' + ytId : '';
                const hasSrc = isYt ? !!embedSrc : !!url;
                const vHtml = isYt
                    ? '<iframe src="' + esc(embedSrc) + '" class="w-full h-full" allowfullscreen></iframe>'
                    : '<video controls class="w-full h-full" style="background:#000"><source src="' + esc(url) + '" type="video/mp4"></video>';
                return '<div class="bg-zinc-900 rounded-xl overflow-hidden shadow-sm">'
                    + '<div class="aspect-video">' + (hasSrc ? vHtml : '<div class="w-full h-full flex items-center justify-center text-zinc-500 text-sm">No video source</div>') + '</div>'
                    + (d.caption ? '<p class="text-xs text-zinc-400 text-center py-2 bg-white dark:bg-zinc-800">' + esc(d.caption) + '</p>' : '') + '</div>';
            },
            editor: (d, id) => {
                console.debug('video editor called', id, d);
                const isUpload = (d.source_type || 'youtube') === 'upload';
                const ac = (a) => a ? 'bg-primary text-white' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-200 dark:hover:bg-zinc-700';
                return `<div class="space-y-4">
                    <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                    <div><label class="block text-xs font-medium text-zinc-500 mb-1">Caption</label><input type="text" value="${esc(d.caption || '')}" onchange="updateSectionData('${id}','caption',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <div class="flex gap-2 mb-3">
                            <button type="button" onclick="updateSectionData('${id}','source_type','youtube');renderSection('${id}')" class="px-3 py-1.5 text-xs rounded-lg font-medium transition-colors ${ac(!isUpload)}">YouTube URL</button>
                            <button type="button" onclick="updateSectionData('${id}','source_type','upload');renderSection('${id}')" class="px-3 py-1.5 text-xs rounded-lg font-medium transition-colors ${ac(isUpload)}">Upload Video</button>
                        </div>
                        ${isUpload
                            ? `<div class="flex items-center gap-2">
                                <input type="text" value="${esc(d.video_url || '')}" placeholder="Paste video URL or" onchange="updateSectionData('${id}','video_url',this.value)" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                                <label class="flex items-center gap-1.5 px-3 py-2 rounded-lg border border-dashed border-zinc-300 dark:border-zinc-600 text-xs text-zinc-500 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer transition-colors whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                    Browse Media
                                    <input type="file" accept="video/mp4,video/webm,video/ogg" class="hidden" onchange="uploadFile(this, '${id}')">
                                </label>
                            </div>`
                            : `<div><input type="text" value="${esc(d.youtube_url || d.url || '')}" placeholder="https://www.youtube.com/watch?v=..." onchange="updateSectionData('${id}','youtube_url',this.value);renderSection('${id}')" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>`
                        }
                        ${d.video_url && isUpload ? '<div class="mt-2"><video controls class="w-full max-h-32 rounded-lg" style="background:#000"><source src="' + esc(d.video_url) + '" type="video/mp4"></video></div>' : ''}
                    </div>
                </div>`;
            }
        },
        stats: {
            label: 'Stats Bar',
            defaultData: { items: [
                { value: '1990', label: 'Founded' },
                { value: '70+', label: 'Member Churches' },
                { value: '3', label: 'Regions' },
                { value: '34+', label: 'Years' },
            ]},
            render: (d) => `<div class="bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-700">
                <div class="grid grid-cols-4 gap-4">${(d.items || []).map(item => `<div class="text-center"><p class="text-2xl font-bold text-primary">${esc(item.value)}</p><p class="text-xs text-zinc-500">${esc(item.label)}</p></div>`).join('')}</div>
            </div>`,
            editor: (d, id) => `<div class="space-y-3">
                <label class="block text-xs font-medium text-zinc-500 mb-1">Stats (value|label per line)</label>
                <textarea rows="5" onchange="updateSectionData('${id}','items',this.value.split('\\n').filter(Boolean).map(l => {const [v,...rest]=l.split('|');return{value:v.trim(),label:rest.join('|').trim()}}))" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm font-mono">${(d.items || []).map(i => i.value + ' | ' + i.label).join('\n')}</textarea>
            </div>`
        },
        cta: {
            label: 'Call to Action',
            defaultData: { heading: 'Join Us Today', content: 'Be part of our community', button_text: 'Get Started', button_url: '#', background: 'navy' },
            render: (d) => `<div class="${d.background === 'navy' ? 'bg-navy text-white' : 'bg-primary text-white'} rounded-xl p-8 text-center shadow-sm">
                <h3 class="text-xl font-bold mb-2">${esc(d.heading)}</h3>
                <p class="text-sm opacity-80 mb-4">${esc(d.content)}</p>
                <a href="${esc(d.button_url || '#')}" class="inline-flex px-5 py-2 rounded-full bg-white text-navy text-sm font-semibold hover:bg-opacity-90 transition-all">${esc(d.button_text)}</a>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Content</label><textarea rows="2" onchange="updateSectionData('${id}','content',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.content)}</textarea></div>
                <div class="grid grid-cols-2 gap-3">
                    <div><label class="block text-xs font-medium text-zinc-500 mb-1">Button Text</label><input type="text" value="${esc(d.button_text)}" onchange="updateSectionData('${id}','button_text',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                    <div><label class="block text-xs font-medium text-zinc-500 mb-1">Button URL</label><input type="text" value="${esc(d.button_url || '#')}" onchange="updateSectionData('${id}','button_url',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                </div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Background</label><select onchange="updateSectionData('${id}','background',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"><option value="navy" ${d.background === 'navy' ? 'selected' : ''}>Navy</option><option value="primary" ${d.background === 'primary' ? 'selected' : ''}>Primary</option></select></div>
            </div>`
        },
        values: {
            label: 'Core Values',
            defaultData: { heading: 'Our Core Values', items: [
                { title: 'Living Biblically', desc: 'Scripture-centered life and doctrine' },
                { title: 'Building Families', desc: 'Strengthening families as foundation' },
                { title: 'Serving the Needy', desc: 'Extending Christ\'s love through service' },
                { title: 'Uplifting Worship', desc: 'Enriching liturgical worship experiences' },
            ]},
            render: (d) => `<div class="bg-navy text-white rounded-xl p-6 shadow-sm">
                ${d.heading ? `<h3 class="text-xl font-bold text-center mb-6">${esc(d.heading)}</h3>` : ''}
                <div class="grid grid-cols-2 gap-4">${(d.items || []).map(item => `<div class="bg-white/5 border border-white/10 rounded-lg p-4"><h4 class="font-semibold text-sm mb-1">${esc(item.title)}</h4><p class="text-xs text-zinc-400">${esc(item.desc)}</p></div>`).join('')}</div>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Values (title|desc per line)</label><textarea rows="6" onchange="updateSectionData('${id}','items',this.value.split('\\n').filter(Boolean).map(l => {const [t,...rest]=l.split('|');return{title:t.trim(),desc:rest.join('|').trim()}}))" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm font-mono">${(d.items || []).map(i => i.title + ' | ' + i.desc).join('\n')}</textarea>
            </div>`
        },
        two_column: {
            label: 'Two Columns',
            defaultData: { left_heading: 'Left Column', left_content: 'Left column content here.', left_image: '', right_heading: 'Right Column', right_content: 'Right column content here.', right_image: '' },
            render: (d) => `<div class="grid md:grid-cols-2 gap-6 bg-white dark:bg-zinc-800 rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-700">
                <div>${d.left_image ? `<img src="${esc(d.left_image)}" class="w-full rounded-lg mb-3 aspect-[4/3] object-cover">` : ''}<h4 class="font-bold text-zinc-900 dark:text-white mb-2">${esc(d.left_heading)}</h4><p class="text-sm text-zinc-600 dark:text-zinc-400">${esc(d.left_content)}</p></div>
                <div>${d.right_image ? `<img src="${esc(d.right_image)}" class="w-full rounded-lg mb-3 aspect-[4/3] object-cover">` : ''}<h4 class="font-bold text-zinc-900 dark:text-white mb-2">${esc(d.right_heading)}</h4><p class="text-sm text-zinc-600 dark:text-zinc-400">${esc(d.right_content)}</p></div>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Left Image</label>
                    <div class="flex items-center gap-2"><input type="text" value="${esc(d.left_image || '')}" placeholder="Image URL" onchange="updateSectionData('${id}','left_image',this.value);renderSections();" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${imgUploadHtml(id, 'left_image')}${d.left_image ? `<button onclick="updateSectionData('${id}','left_image','');renderSections();renderEditor('${id}')" class="p-1.5 rounded hover:bg-primary/10 text-zinc-400 hover:text-primary" title="Remove"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>` : ''}</div>
                    ${d.left_image ? `<img src="${esc(d.left_image)}" class="h-20 w-full object-cover rounded border border-zinc-200 dark:border-zinc-700 mt-1">` : ''}
                </div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Left Heading</label>${headingEditor(id, 'left_heading', d.left_heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Left Content</label><textarea rows="3" onchange="updateSectionData('${id}','left_content',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.left_content)}</textarea></div>
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4"><label class="block text-xs font-medium text-zinc-500 mb-1">Right Image</label>
                    <div class="flex items-center gap-2"><input type="text" value="${esc(d.right_image || '')}" placeholder="Image URL" onchange="updateSectionData('${id}','right_image',this.value);renderSections();" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${imgUploadHtml(id, 'right_image')}${d.right_image ? `<button onclick="updateSectionData('${id}','right_image','');renderSections();renderEditor('${id}')" class="p-1.5 rounded hover:bg-primary/10 text-zinc-400 hover:text-primary" title="Remove"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>` : ''}</div>
                    ${d.right_image ? `<img src="${esc(d.right_image)}" class="h-20 w-full object-cover rounded border border-zinc-200 dark:border-zinc-700 mt-1">` : ''}
                </div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Right Heading</label>${headingEditor(id, 'right_heading', d.right_heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Right Content</label><textarea rows="3" onchange="updateSectionData('${id}','right_content',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.right_content)}</textarea></div>
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                    <label class="block text-xs font-medium text-zinc-500 mb-2">Left Button</label>
                    <div class="grid grid-cols-2 gap-2"><input type="text" value="${esc(d.left_button_text || '')}" placeholder="Button text" onchange="updateSectionData('${id}','left_button_text',this.value)" class="px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"><input type="text" value="${esc(d.left_button_url || '')}" placeholder="URL" onchange="updateSectionData('${id}','left_button_url',this.value)" class="px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-zinc-500 mb-2">Right Button</label>
                    <div class="grid grid-cols-2 gap-2"><input type="text" value="${esc(d.right_button_text || '')}" placeholder="Button text" onchange="updateSectionData('${id}','right_button_text',this.value)" class="px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"><input type="text" value="${esc(d.right_button_url || '')}" placeholder="URL" onchange="updateSectionData('${id}','right_button_url',this.value)" class="px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                </div>
            </div>`
        },
        hero_slider: {
            label: 'Hero Slider',
            defaultData: { slides: [
                { title: 'Slide 1 Title', subtitle: 'Slide 1 subtitle', image: 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=1200&q=80' },
                { title: 'Slide 2 Title', subtitle: 'Slide 2 subtitle', image: 'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1200&q=80' },
            ]},
            render: (d) => `<div class="relative h-64 bg-gradient-to-br from-zinc-800 to-zinc-900 rounded-xl flex items-center justify-center text-white overflow-hidden">
                ${d.slides?.length ? `<div class="text-center p-8"><h2 class="text-xl font-bold mb-1">${esc(d.slides[0].title)}</h2><p class="text-sm opacity-80">${esc(d.slides[0].subtitle)}</p></div>` : '<div class="text-zinc-400">No slides</div>'}
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Badge Text</label><input type="text" value="${esc(d.badge_text || '')}" onchange="updateSectionData('${id}','badge_text',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                    <label class="block text-xs font-medium text-zinc-500 mb-2">Slides</label>
                    <div id="slides-container-${id}">
                        ${(d.slides || []).map((slide, i) => `<div class="slide-item mb-3 p-3 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium text-zinc-500">Slide ${i + 1}</span>
                                <button onclick="removeSlide('${id}', ${i})" class="p-1 rounded hover:bg-primary/10 dark:hover:bg-primary/20 text-zinc-400 hover:text-primary">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                            <input type="text" value="${esc(slide.title || '')}" placeholder="Title" onchange="updateSlide('${id}', ${i}, 'title', this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm mb-2">
                            <input type="text" value="${esc(slide.subtitle || '')}" placeholder="Subtitle" onchange="updateSlide('${id}', ${i}, 'subtitle', this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm mb-2">
                            <div class="flex items-center gap-2">
                                <input type="text" value="${esc(slide.image || '')}" placeholder="Image URL" onchange="updateSlide('${id}', ${i}, 'image', this.value)" class="flex-1 px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                                ${imgUploadHtml(id, 'slides', i)}
                            </div>
                            ${slide.image ? `<img src="${esc(slide.image)}" class="h-16 w-full object-cover rounded mt-1">` : ''}
                        </div>`).join('')}
                    </div>
                    <button onclick="addSlide('${id}')" class="w-full mt-2 px-3 py-2 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 text-xs text-zinc-500 hover:border-primary hover:text-primary transition-colors">+ Add Slide</button>
                </div>
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                    <label class="block text-xs font-medium text-zinc-500 mb-2">Buttons</label>
                    <div class="grid grid-cols-2 gap-2">
                        <div><input type="text" value="${esc(d.button_primary_text || '')}" placeholder="Primary Text" onchange="updateSectionData('${id}','button_primary_text',this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                        <div><input type="text" value="${esc(d.button_primary_url || '')}" placeholder="Primary URL" onchange="updateSectionData('${id}','button_primary_url',this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                        <div><input type="text" value="${esc(d.button_secondary_text || '')}" placeholder="Secondary Text" onchange="updateSectionData('${id}','button_secondary_text',this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                        <div><input type="text" value="${esc(d.button_secondary_url || '')}" placeholder="Secondary URL" onchange="updateSectionData('${id}','button_secondary_url',this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                    </div>
                </div>
            </div>`
        },
        vision_mission: {
            label: 'Vision & Mission',
            defaultData: { vision_heading: 'Our Vision', vision_content: '"A Christian Community Promoting Renewed, Healed and Prayerful Christians"', mission_heading: 'Our Mission', mission_content: '"To Discover United; Christian Centred Answers to the Current Challenges of Life"' },
            render: (d) => `<div class="grid md:grid-cols-2 gap-4">
                <div class="bg-white dark:bg-zinc-800 rounded-xl p-5 shadow-sm border border-zinc-200 dark:border-zinc-700">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h4 class="font-bold text-zinc-900 dark:text-white mb-1 text-sm">${esc(d.vision_heading)}</h4>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 italic">${esc(d.vision_content)}</p>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded-xl p-5 shadow-sm border border-zinc-200 dark:border-zinc-700">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h4 class="font-bold text-zinc-900 dark:text-white mb-1 text-sm">${esc(d.mission_heading)}</h4>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 italic">${esc(d.mission_content)}</p>
                </div>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Vision Heading</label>${headingEditor(id, 'vision_heading', d.vision_heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Vision Content</label><textarea rows="3" onchange="updateSectionData('${id}','vision_content',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.vision_content)}</textarea></div>
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4"><label class="block text-xs font-medium text-zinc-500 mb-1">Mission Heading</label>${headingEditor(id, 'mission_heading', d.mission_heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Mission Content</label><textarea rows="3" onchange="updateSectionData('${id}','mission_content',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.mission_content)}</textarea></div>
            </div>`
        },
        recent_posts: {
            label: 'Recent Posts',
            defaultData: { heading: 'Latest <span class="text-red">News</span>', subtitle: 'UPDATES', limit: 3, background: 'wwhite' },
            render: (d) => `<div class="bg-wwhite rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-700">
                ${d.heading ? `<h3 class="text-xl font-bold text-zinc-900 dark:text-white text-center mb-2">${d.heading}</h3>` : ''}
                <p class="text-xs text-zinc-500 dark:text-zinc-400 text-center">Recent posts section — up to ${d.limit || 3} posts</p>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Subtitle</label><input type="text" value="${esc(d.subtitle || '')}" onchange="updateSectionData('${id}','subtitle',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Number of Posts</label>
                    <select onchange="updateSectionData('${id}','limit',parseInt(this.value))" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                        ${[3,4,6].map(n => `<option value="${n}" ${(d.limit||3) === n ? 'selected' : ''}>${n}</option>`).join('')}
                    </select>
                </div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Background</label>
                    <select onchange="updateSectionData('${id}','background',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                        <option value="wwhite" ${d.background === 'wwhite' ? 'selected' : ''}>White</option>
                        <option value="dark" ${d.background === 'dark' ? 'selected' : ''}>Dark (Navy)</option>
                    </select>
                </div>
            </div>`
        },
        team: {
            label: 'Team Members',
            defaultData: { heading: 'Our <span class="text-primary">Leadership</span>', subtitle: 'MEET THE TEAM', items: [
                { name: 'Rev. John Doe', role: 'Chairperson', photo: '', bio: 'Brief biography of the team member.' },
                { name: 'Sr. Jane Smith', role: 'Vice Chairperson', photo: '', bio: 'Brief biography of the team member.' },
            ]},
            render: (d) => `<div class="bg-wwhite rounded-xl p-6 shadow-sm border border-zinc-200 dark:border-zinc-700">
                ${d.heading ? `<h3 class="text-xl font-bold text-zinc-900 dark:text-white text-center mb-1">${d.heading}</h3>` : ''}
                ${d.subtitle ? `<p class="text-xs text-primary font-semibold text-center tracking-widest uppercase mb-6">${esc(d.subtitle)}</p>` : ''}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    ${(d.items || []).map(item => `<div class="text-center p-3 rounded-lg border border-zinc-100 dark:border-zinc-700">
                        <div class="w-16 h-16 mx-auto rounded-full bg-zinc-200 dark:bg-zinc-700 mb-2 flex items-center justify-center overflow-hidden">${item.photo ? `<img src="${esc(item.photo)}" class="w-full h-full object-cover">` : `<svg class="w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>`}</div>
                        <h4 class="font-semibold text-sm text-zinc-900 dark:text-white">${esc(item.name)}</h4>
                        <p class="text-xs text-primary font-medium">${esc(item.role)}</p>
                    </div>`).join('')}
                </div>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Subtitle</label><input type="text" value="${esc(d.subtitle || '')}" onchange="updateSectionData('${id}','subtitle',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                    <label class="block text-xs font-medium text-zinc-500 mb-2">Team Members</label>
                    <div id="members-container-${id}">
                        ${(d.items || []).map((item, i) => `<div class="member-item mb-3 p-3 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-medium text-zinc-500">Member ${i + 1}</span>
                                <button onclick="removeMember('${id}', ${i})" class="p-1 rounded hover:bg-primary/10 dark:hover:bg-primary/20 text-zinc-400 hover:text-primary">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                            <div class="flex items-center gap-2 mb-2">
                                <input type="text" value="${esc(item.photo || '')}" placeholder="Photo URL" onchange="updateMember('${id}', ${i}, 'photo', this.value)" class="flex-1 px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                                <div class="mt-1"><button type="button" onclick="openMediaModal(function(url){updateMember('${id}',${i},'photo',url);renderSections();renderEditor('${id}')})" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-xs font-medium text-zinc-600 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 cursor-pointer transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg> Browse Media</button></div>
                            </div>
                            ${item.photo ? `<img src="${esc(item.photo)}" class="h-12 w-12 rounded-full object-cover mb-2">` : ''}
                            <input type="text" value="${esc(item.name || '')}" placeholder="Name" onchange="updateMember('${id}', ${i}, 'name', this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm mb-2">
                            <input type="text" value="${esc(item.role || '')}" placeholder="Role / Title" onchange="updateMember('${id}', ${i}, 'role', this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm mb-2">
                            <textarea rows="2" placeholder="Brief bio" onchange="updateMember('${id}', ${i}, 'bio', this.value)" class="w-full px-3 py-1.5 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(item.bio || '')}</textarea>
                        </div>`).join('')}
                    </div>
                    <button onclick="addMember('${id}')" class="w-full mt-2 px-3 py-2 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 text-xs text-zinc-500 hover:border-primary hover:text-primary transition-colors">+ Add Member</button>
                </div>
                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4"><label class="block text-xs font-medium text-zinc-500 mb-1">Background</label>
                    <select onchange="updateSectionData('${id}','background',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                        <option value="wwhite" ${d.background === 'dark' ? '' : 'selected'}>White</option>
                        <option value="dark" ${d.background === 'dark' ? 'selected' : ''}>Dark (Navy)</option>
                    </select>
                </div>
            </div>`
        },
        volunteer_form: {
            label: 'Volunteer / Membership Form',
            defaultData: {
                heading: 'Volunteer &amp; <span class=&quot;text-primary&quot;>Membership</span>',
                subtitle: 'Fill out the form below to express your interest in volunteering or becoming a member of WCCF.',
                label: 'JOIN US',
                button_text: 'Submit Application',
                form_type: 'volunteer',
                show_church_field: true,
                message_label: 'Your Message / Why you want to get involved',
                message_placeholder: 'Tell us about your skills, availability, and why you want to serve...',
                background: 'light',
            },
            render: (d) => `<div class="bg-${d.background === 'dark' ? 'navy text-white' : 'surface'} py-16 px-6 text-center rounded-xl">
                <div class="max-w-md mx-auto">
                    ${d.label ? `<span class="text-xs font-semibold tracking-widest uppercase text-red">${esc(d.label)}</span>` : ''}
                    <h3 class="text-2xl font-bold mt-2 mb-3 ${d.background === 'dark' ? 'text-white' : 'text-navy'}">${esc(d.heading)}</h3>
                    <p class="text-sm ${d.background === 'dark' ? 'text-gray-300' : 'text-gray-600'}">${esc(d.subtitle)}</p>
                    <div class="mt-6 inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white text-sm font-semibold shadow-lg">${esc(d.button_text)}</div>
                </div>
            </div>`,
            editor: (d, id) => `<div class="space-y-4">
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Label (badge)</label><input type="text" value="${esc(d.label || '')}" onchange="updateSectionData('${id}','label',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Heading</label>${headingEditor(id, 'heading', d.heading)}</div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Subtitle</label><textarea rows="2" onchange="updateSectionData('${id}','subtitle',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">${esc(d.subtitle)}</textarea></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Button Text</label><input type="text" value="${esc(d.button_text || 'Submit Application')}" onchange="updateSectionData('${id}','button_text',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Form Type</label>
                    <select onchange="updateSectionData('${id}','form_type',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                        <option value="volunteer" ${d.form_type === 'volunteer' ? 'selected' : ''}>Volunteer</option>
                        <option value="membership" ${d.form_type === 'membership' ? 'selected' : ''}>Membership</option>
                        <option value="general" ${d.form_type === 'general' ? 'selected' : ''}>General Inquiry</option>
                    </select>
                </div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Message Label</label><input type="text" value="${esc(d.message_label || '')}" onchange="updateSectionData('${id}','message_label',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Message Placeholder</label><input type="text" value="${esc(d.message_placeholder || '')}" onchange="updateSectionData('${id}','message_placeholder',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm"></div>
                <div><label class="flex items-center gap-2 text-sm font-medium text-zinc-500"><input type="checkbox" ${d.show_church_field !== false ? 'checked' : ''} onchange="updateSectionData('${id}','show_church_field',this.checked)" class="rounded border-zinc-300 dark:border-zinc-600"> Show Church field</label></div>
                <div><label class="block text-xs font-medium text-zinc-500 mb-1">Background</label>
                    <select onchange="updateSectionData('${id}','background',this.value)" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-sm">
                        <option value="light" ${d.background !== 'dark' ? 'selected' : ''}>Light</option>
                        <option value="dark" ${d.background === 'dark' ? 'selected' : ''}>Dark (Navy)</option>
                    </select>
                </div>
            </div>`
        },
    };

    // State
    let sections = [];
    let selectedSectionId = null;
    let dirty = false;

    function esc(str) {
        if (!str) return '';
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function generateId() {
        return 'sec_' + Date.now().toString(36) + '_' + Math.random().toString(36).slice(2, 6);
    }

    function renderSection(id) {
        renderSections();
        renderEditor(id);
    }

    function addSection(type) {
        const def = SECTION_TYPES[type];
        if (!def) return;
        sections.push({
            id: generateId(),
            type: type,
            data: JSON.parse(JSON.stringify(def.defaultData))
        });
        dirty = true;
        renderSections();
        updateSaveStatus();
    }

    function removeSection(id) {
        if (!confirm('Remove this section?')) return;
        sections = sections.filter(s => s.id !== id);
        if (selectedSectionId === id) {
            selectedSectionId = null;
            renderEditor(null);
        }
        dirty = true;
        renderSections();
        updateSaveStatus();
    }

    function duplicateSection(id) {
        const idx = sections.findIndex(s => s.id === id);
        if (idx === -1) return;
        const clone = JSON.parse(JSON.stringify(sections[idx]));
        clone.id = generateId();
        sections.splice(idx + 1, 0, clone);
        dirty = true;
        renderSections();
        updateSaveStatus();
    }

    function selectSection(id) {
        selectedSectionId = id;
        renderSections();
        renderEditor(id);
    }

    function updateSectionData(id, key, value) {
        const section = sections.find(s => s.id === id);
        if (!section) return;
        section.data[key] = value;
        dirty = true;
        renderSections();
        updateSaveStatus();
    }

    function renderSections() {
        const container = document.getElementById('sections-container');
        if (!container) return;
        container.innerHTML = sections.map(s => {
            const def = SECTION_TYPES[s.type];
            if (!def) return '';
            const isSelected = s.id === selectedSectionId;
            return `<div class="section-item ${isSelected ? 'ring-2 ring-primary' : 'ring-1 ring-zinc-300 dark:ring-zinc-600'} rounded-xl bg-white dark:bg-zinc-800 cursor-pointer transition-all hover:ring-primary/30" data-id="${s.id}" onclick="selectSection('${s.id}')">
                <div class="flex items-center justify-between px-4 py-2 bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700 rounded-t-xl">
                    <div class="flex items-center gap-2">
                        <span class="drag-handle cursor-grab text-zinc-400 hover:text-zinc-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 6h2v2H8V6zm6 0h2v2h-2V6zM8 11h2v2H8v-2zm6 0h2v2h-2v-2zm-6 5h2v2H8v-2zm6 0h2v2h-2v-2z"/></svg>
                        </span>
                        <span class="text-xs font-semibold text-zinc-500 uppercase tracking-wider">${def.label}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <button onclick="event.stopPropagation();duplicateSection('${s.id}')" class="p-1 rounded hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-400 hover:text-zinc-600" title="Duplicate">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </button>
                        <button onclick="event.stopPropagation();removeSection('${s.id}')" class="p-1 rounded hover:bg-primary/10 dark:hover:bg-primary/20 text-zinc-400 hover:text-primary" title="Remove">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    ${def.render(s.data)}
                </div>
            </div>`;
        }).join('');

        // Init Sortable
        if (window.sortableInstance) window.sortableInstance.destroy();
        window.sortableInstance = new Sortable(document.getElementById('sections-container'), {
            handle: '.drag-handle',
            animation: 200,
            onEnd: function(evt) {
                const moved = sections.splice(evt.oldIndex, 1)[0];
                sections.splice(evt.newIndex, 0, moved);
                dirty = true;
                updateSaveStatus();
            }
        });
    }

    function renderEditor(id) {
        const container = document.getElementById('editor-content');
        if (!container) return;
        if (!id) {
            container.innerHTML = `<p class="text-xs text-zinc-400 text-center py-8">Select a section to edit</p>`;
            return;
        }
        const section = sections.find(s => s.id === id);
        if (!section) return;
        const def = SECTION_TYPES[section.type];
        if (!def) return;
        try {
            const html = def.editor(section.data, section.id);
            container.innerHTML = `<div class="space-y-4"><div class="flex items-center justify-between mb-4"><h4 class="text-sm font-semibold text-zinc-900 dark:text-white">${def.label}</h4><span class="text-xs text-zinc-400 font-mono">${section.type}</span></div>${html}</div>`;
        } catch (e) {
            console.error('Editor render error:', e);
            container.innerHTML = `<p class="text-xs text-red-500 text-center py-8">Editor error: ${e.message}</p>`;
        }
    }

    function showToast(text, variant) {
        document.dispatchEvent(new CustomEvent('toast-show', {
            detail: { text: text, variant: variant || 'success' }
        }));
    }

    function updateSaveStatus() {
        const el = document.getElementById('save-status');
        if (el) el.textContent = 'Unsaved changes';
    }

    function saveSections() {
        const btn = document.querySelector('button[onclick="saveSections()"]');
        const status = document.getElementById('save-status');
        if (btn) { btn.disabled = true; btn.textContent = 'Saving...'; }
        fetch('{{ route('admin.pages.sections.save', $page) }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ sections: JSON.stringify(sections) })
        }).then(r => r.json()).then(data => {
            if (data.success) {
                dirty = false;
                if (status) status.textContent = 'All changes saved';
                if (btn) { btn.disabled = false; btn.textContent = 'Save'; }
                showToast('Changes saved');
            }
        }).catch(() => {
            if (status) status.textContent = 'Save failed!';
            if (btn) { btn.disabled = false; btn.textContent = 'Save'; }
        });
    }

    // Toast handler
    document.addEventListener('toast-show', function(e) {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-6 right-6 z-50 px-5 py-3 rounded-xl shadow-2xl text-white text-sm font-medium transition-all duration-300 translate-y-2 opacity-0';
        const bg = e.detail.variant === 'error' ? 'bg-red-600' : 'bg-green-600';
        toast.className += ' ' + bg;
        toast.textContent = e.detail.text || '';
        document.body.appendChild(toast);
        requestAnimationFrame(() => { toast.classList.remove('translate-y-2', 'opacity-0'); });
        setTimeout(() => {
            toast.classList.add('translate-y-2', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    });

    // Load existing sections or defaults
    document.addEventListener('DOMContentLoaded', function() {
        try {
            const existing = @json($page->content ?? []);
            if (Array.isArray(existing) && existing.length > 0) {
                sections = existing;
            } else {
                // Default sections per page
                const pageSlug = '{{ $page->slug }}';
                const defaults = {
                    home: [
                        { type: 'hero', data: { title: 'Uniting the West Nile Community in Faith', subtitle: 'West Nile Christian Community Fellowship — a faith-based community promoting renewed, healed, and prayerful Christians.', image: 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=1200&q=80', overlay: true } },
                        { type: 'stats', data: { items: [{value:'1990',label:'Founded'},{value:'70+',label:'Churches'},{value:'3',label:'Regions'},{value:'34+',label:'Years'}] } },
                        { type: 'vision_mission', data: { vision_heading: 'Our Vision', vision_content: '"A Christian Community Promoting Renewed, Healed and Prayerful Christians"', mission_heading: 'Our Mission', mission_content: '"To Discover United; Christian Centred Answers to the Current Challenges of Life"' } },
                        { type: 'recent_posts', data: { heading: 'Latest <span class=&quot;text-red&quot;>News</span>', subtitle: 'UPDATES', limit: 3, background: 'wwhite' } },
                        { type: 'cta', data: { heading: 'Join Us in Faith & Fellowship', content: 'Whether you\'re looking for a spiritual home, want to serve, or need support — WCCF welcomes you.', button_text: 'Get Involved', button_url: '/get-involved', background: 'navy' } },
                    ],
                    'who-we-are': [
                        { type: 'hero', data: { title: 'Who We Are', subtitle: 'Our story, beliefs, and the community behind WCCF.', image: 'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1200&q=80' } },
                        { type: 'text_block', data: { heading: 'Our Story', content: 'WCCF transformed from the former Lugbara Christian Community Fellowship (LCCF) founded in 1990. Guided by Hebrews 10:25, we unite the West Nile community in diaspora to fellowship in their own languages.' } },
                        { type: 'values', data: { heading: 'Our Core Values', items: [{title:'Living Biblically',desc:'Scripture-centered life and doctrine'},{title:'Building Families',desc:'Strengthening families as foundation'},{title:'Serving the Needy',desc:'Extending Christ\'s love through service'},{title:'Uplifting Worship',desc:'Enriching worship experiences'}] } },
                    ],
                    'what-we-do': [
                        { type: 'hero', data: { title: 'What We Do', subtitle: 'Our ministries, programs, and community outreach initiatives.', image: 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=1200&q=80' } },
                        { type: 'text_block', data: { heading: 'Our Ministries', content: 'We organize annual conferences, departmental fellowships, community outreach programs, and more to serve the West Nile Christian community.' } },
                    ],
                    'get-involved': [
                        { type: 'hero', data: { title: 'Get Involved', subtitle: 'Join us in serving the community and growing in faith together.', image: 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1200&q=80' } },
                        { type: 'text_block', data: { heading: 'Ways to Serve', content: 'There are many ways to get involved with WCCF — from volunteering at events to joining a fellowship group.' } },
                    ],
                    donate: [
                        { type: 'hero', data: { title: 'Make a Donation', subtitle: 'Your generous giving enables WCCF to continue uniting the West Nile community in faith.', image: 'https://images.unsplash.com/photo-1593113630400-ea4288922497?w=1200&q=80' } },
                        { type: 'text_block', data: { heading: 'Ways to Give', content: 'Every contribution — no matter the size — makes an eternal impact in the lives of God\'s people.' } },
                    ],
                };
                sections = defaults[pageSlug] || [];
                // Auto-save defaults
                setTimeout(() => saveSections(), 500);
            }
        } catch(e) { console.error(e); sections = []; }
        renderSections();
        if (sections.length > 0) selectSection(sections[0].id);
    });
    // ─── Media Modal ────────────────────────────────────────────────────
    let mediaCallback = null;
    let selectedMediaId = null;
    let selectedMediaEl = null;

    function openMediaModal(callback) {
        mediaCallback = callback;
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
        if (!selectedMediaId || !mediaCallback) { closeMediaModal(); return; }
        const url = selectedMediaEl ? selectedMediaEl.dataset.url : '';
        if (url) mediaCallback(url);
        mediaCallback = null;
        selectedMediaId = null;
        selectedMediaEl = null;
        document.querySelectorAll('.media-item').forEach(i => i.classList.remove('selected'));
        closeMediaModal();
    }

    function uploadMedia(input) {
        const file = input.files[0];
        if (!file) return;
        const fd = new FormData();
        fd.append('file', file);
        fd.append('_token', CSRF_TOKEN);
        fetch(UPLOAD_URL, { method: 'POST', body: fd })
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

    {{-- Media Browser Modal --}}
    <div id="media-modal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/50" onclick="closeMediaModal()"></div>
        <div class="absolute inset-4 md:inset-10 bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl flex flex-col overflow-hidden" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 flex-shrink-0">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Media Library</h2>
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 px-4 py-2 rounded-lg border border-dashed border-zinc-300 dark:border-zinc-600 text-sm text-zinc-500 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Upload
                        <input type="file" accept="image/*" class="hidden" onchange="uploadMedia(this)">
                    </label>
                    <button onclick="closeMediaModal()" class="p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-400 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-y-auto p-6">
                <div id="media-grid" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-3">
                    @foreach($mediaItems as $m)
                        <div class="media-item relative aspect-square rounded-lg overflow-hidden border-2 border-transparent" data-id="{{ $m->id }}" data-url="{{ $m->url }}" onclick="selectMedia(this, {{ $m->id }})">
                            <img src="{{ $m->url }}" alt="{{ $m->name }}" class="w-full h-full object-cover">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 to-transparent p-1.5">
                                <p class="text-[10px] text-white truncate leading-tight">{{ $m->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-between px-6 py-4 border-t border-zinc-200 dark:border-zinc-700 flex-shrink-0">
                <p class="text-sm text-zinc-500" id="media-selected-info">No image selected</p>
                <div class="flex items-center gap-3">
                    <button onclick="closeMediaModal()" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Cancel</button>
                    <button onclick="confirmMediaSelection()" class="px-5 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary-dark transition-colors">Choose</button>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
