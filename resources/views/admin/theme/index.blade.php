<x-layouts::app :title="__('Theme Settings')">
    <style>
        .media-item { cursor: pointer; transition: all 0.15s; }
        .media-item:hover { border-color: #560534; box-shadow: 0 0 0 2px rgba(86,5,52,0.2); }
        .media-item.selected { border-color: #560534; box-shadow: 0 0 0 2px rgba(86,5,52,0.4); }
        .media-item img { pointer-events: none; }
    </style>
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Theme Settings</h1>
            <p class="text-sm text-zinc-500 mt-1">Customize your website colors, fonts, and branding.</p>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.theme.update') }}" class="max-w-3xl space-y-8">
            @csrf

            {{-- Colors --}}
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Colors</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Primary Color</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="theme_primary_color" value="{{ $settings->get('theme_primary_color')->value ?? '#560534' }}" class="w-10 h-10 rounded border border-zinc-300 dark:border-zinc-600 cursor-pointer">
                            <input type="text" name="theme_primary_color_hex" value="{{ $settings->get('theme_primary_color')->value ?? '#560534' }}" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Secondary Color (Navy)</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="theme_secondary_color" value="{{ $settings->get('theme_secondary_color')->value ?? '#0f1b2d' }}" class="w-10 h-10 rounded border border-zinc-300 dark:border-zinc-600 cursor-pointer">
                            <input type="text" name="theme_secondary_color_hex" value="{{ $settings->get('theme_secondary_color')->value ?? '#0f1b2d' }}" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm font-mono">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fonts --}}
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Fonts</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Heading Font</label>
                        <select name="theme_heading_font" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                            <option value="Rubik" @selected(($settings->get('theme_heading_font')->value ?? 'Rubik') === 'Rubik')>Rubik</option>
                            <option value="Inter" @selected(($settings->get('theme_heading_font')->value ?? 'Rubik') === 'Inter')>Inter</option>
                            <option value="Poppins" @selected(($settings->get('theme_heading_font')->value ?? 'Rubik') === 'Poppins')>Poppins</option>
                            <option value="Montserrat" @selected(($settings->get('theme_heading_font')->value ?? 'Rubik') === 'Montserrat')>Montserrat</option>
                            <option value="Playfair Display" @selected(($settings->get('theme_heading_font')->value ?? 'Rubik') === 'Playfair Display')>Playfair Display</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Body Font</label>
                        <select name="theme_body_font" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                            <option value="Lato" @selected(($settings->get('theme_body_font')->value ?? 'Lato') === 'Lato')>Lato</option>
                            <option value="Inter" @selected(($settings->get('theme_body_font')->value ?? 'Lato') === 'Inter')>Inter</option>
                            <option value="Open Sans" @selected(($settings->get('theme_body_font')->value ?? 'Lato') === 'Open Sans')>Open Sans</option>
                            <option value="Roboto" @selected(($settings->get('theme_body_font')->value ?? 'Lato') === 'Roboto')>Roboto</option>
                            <option value="Nunito" @selected(($settings->get('theme_body_font')->value ?? 'Lato') === 'Nunito')>Nunito</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Logo & Favicon --}}
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Branding</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Logo</label>
                        <div class="flex items-center gap-2">
                            <input type="text" name="theme_logo_url" id="theme_logo_url" value="{{ $settings->get('theme_logo_url')->value ?? '' }}" placeholder="https://example.com/logo.png" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                            <button type="button" onclick="openMediaModal(function(url){ document.getElementById('theme_logo_url').value = url; })" class="flex items-center gap-1.5 px-3 py-2 rounded-lg border border-dashed border-zinc-300 dark:border-zinc-600 text-xs font-medium text-zinc-500 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer whitespace-nowrap transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Browse Media
                            </button>
                        </div>
                        <div id="logo_preview" class="mt-2 {{ $settings->get('theme_logo_url')?->value ? '' : 'hidden' }}">
                            <img src="{{ $settings->get('theme_logo_url')->value ?? '' }}" class="h-12 object-contain rounded border border-zinc-200 dark:border-zinc-700 p-1">
                            <button type="button" onclick="document.getElementById('theme_logo_url').value='';this.parentElement.classList.add('hidden')" class="mt-1 text-xs text-red-500 hover:text-red-700">Remove</button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Favicon</label>
                        <div class="flex items-center gap-2">
                            <input type="text" name="theme_favicon_url" id="theme_favicon_url" value="{{ $settings->get('theme_favicon_url')->value ?? '' }}" placeholder="/favicon.ico" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                            <button type="button" onclick="openMediaModal(function(url){ document.getElementById('theme_favicon_url').value = url; })" class="flex items-center gap-1.5 px-3 py-2 rounded-lg border border-dashed border-zinc-300 dark:border-zinc-600 text-xs font-medium text-zinc-500 dark:text-zinc-400 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer whitespace-nowrap transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Browse Media
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary-dark transition-colors">Save Theme Settings</button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
    let mediaCallback = null;
    let selectedMediaId = null;
    let selectedMediaEl = null;
    const CSRF_TOKEN = '{{ csrf_token() }}';
    const UPLOAD_URL = '{{ route('admin.media.upload') }}';

    function openMediaModal(callback) {
        mediaCallback = callback;
        document.getElementById('media-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeMediaModal() {
        document.getElementById('media-modal').classList.add('hidden');
        document.body.style.overflow = '';
        selectedMediaId = null;
        selectedMediaEl = null;
    }

    function selectMedia(el, id) {
        if (selectedMediaEl) selectedMediaEl.classList.remove('selected');
        el.classList.add('selected');
        selectedMediaId = id;
        selectedMediaEl = el;
        document.getElementById('media-selected-info').textContent = '1 image selected';
    }

    function confirmMediaSelection() {
        if (!selectedMediaEl) return;
        const url = selectedMediaEl.dataset.url;
        if (url && mediaCallback) mediaCallback(url);
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
                document.getElementById('media-selected-info').textContent = 'No image selected';
            });
    }
    </script>
    @endpush

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
                    @foreach($mediaItems ?? [] as $m)
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
