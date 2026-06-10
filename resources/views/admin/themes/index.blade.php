<x-layouts::app :title="__('Theme Manager')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Theme Manager</h1>
                <p class="text-sm text-zinc-500 mt-1">Install, activate, and manage your website themes.</p>
            </div>
            <flux:modal.trigger name="upload-theme-modal">
                <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary-dark transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Upload Theme
                </button>
            </flux:modal.trigger>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="rounded-lg bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($themes as $theme)
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden @if($theme['is_active']) ring-2 ring-primary @endif">
                    {{-- Screenshot --}}
                    <div class="aspect-video bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center overflow-hidden">
                        @if($theme['screenshot_url'])
                            <img src="{{ $theme['screenshot_url'] }}" alt="{{ $theme['name'] }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-12 h-12 text-zinc-300 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-base font-semibold text-zinc-900 dark:text-white">{{ $theme['name'] }}</h3>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">v{{ $theme['version'] }} by {{ $theme['author'] }}</p>
                            </div>
                            @if($theme['is_active'])
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Active</span>
                            @endif
                        </div>

                        <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed line-clamp-2 mb-4">{{ $theme['description'] }}</p>

                        <div class="flex items-center gap-2">
                            @if($theme['tags'] ?? false)
                                @foreach(array_slice($theme['tags'], 0, 3) as $tag)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs bg-zinc-100 dark:bg-zinc-700 text-zinc-500 dark:text-zinc-400">{{ $tag }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="px-5 py-3 border-t border-neutral-200 dark:border-neutral-700 bg-zinc-50 dark:bg-zinc-800/50 flex items-center justify-between">
                        @if($theme['is_active'])
                            <span class="text-xs text-green-600 dark:text-green-400 font-medium">Currently active</span>
                        @else
                            <form method="POST" action="{{ route('admin.themes.activate') }}">
                                @csrf
                                <input type="hidden" name="slug" value="{{ $theme['slug'] }}">
                                <button type="submit" class="text-xs font-medium text-primary hover:text-primary-dark transition-colors">Activate</button>
                            </form>
                        @endif

                        @if(!$theme['is_default'] && !$theme['is_active'])
                            <form method="POST" action="{{ route('admin.themes.uninstall') }}" onsubmit="return confirm('Uninstall &quot;{{ $theme['name'] }}&quot;? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <input type="hidden" name="slug" value="{{ $theme['slug'] }}">
                                <button type="submit" class="text-xs font-medium text-red-500 hover:text-red-600 transition-colors">Uninstall</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Upload modal --}}
    <flux:modal name="upload-theme-modal" class="max-w-md w-full">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-1">Upload Theme</h3>
            <p class="text-sm text-zinc-500 mb-6">Upload a theme zip file. The archive must contain a <code class="text-xs bg-zinc-100 dark:bg-zinc-700 px-1 py-0.5 rounded">theme.json</code> at the root.</p>

            <form method="POST" action="{{ route('admin.themes.upload') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <input type="file" name="theme_zip" accept=".zip" required class="w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors cursor-pointer">
                </div>
                <div class="flex justify-end gap-3">
                    <flux:modal.close>
                        <button type="button" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Cancel</button>
                    </flux:modal.close>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-primary text-white text-sm font-medium hover:bg-primary-dark transition-colors">Install</button>
                </div>
            </form>
        </div>
    </flux:modal>
</x-layouts::app>
