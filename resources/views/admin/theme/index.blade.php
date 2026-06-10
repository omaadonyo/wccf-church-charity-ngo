<x-layouts::app :title="__('Theme Settings')">
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
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Primary Color (Red)</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="theme_primary_color" value="{{ $settings->get('theme_primary_color')->value ?? '#c0392b' }}" class="w-10 h-10 rounded border border-zinc-300 dark:border-zinc-600 cursor-pointer">
                            <input type="text" name="theme_primary_color_hex" value="{{ $settings->get('theme_primary_color')->value ?? '#c0392b' }}" class="flex-1 px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm font-mono">
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
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Logo URL</label>
                        <input type="text" name="theme_logo_url" value="{{ $settings->get('theme_logo_url')->value ?? '' }}" placeholder="https://example.com/logo.png" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                        @if($settings->get('theme_logo_url')?->value)
                            <img src="{{ $settings->get('theme_logo_url')->value }}" class="mt-2 h-10 object-contain rounded border border-zinc-200 dark:border-zinc-700 p-1">
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Favicon URL</label>
                        <input type="text" name="theme_favicon_url" value="{{ $settings->get('theme_favicon_url')->value ?? '' }}" placeholder="/favicon.ico" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">Save Theme Settings</button>
            </div>
        </form>
    </div>
</x-layouts::app>
