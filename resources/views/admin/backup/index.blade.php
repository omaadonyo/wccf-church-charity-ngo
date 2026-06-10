<x-layouts::app :title="__('Backup &amp; Import')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Backup &amp; Import</h1>
            <p class="text-sm text-zinc-500 mt-1">Export all site content (pages, blog posts, media, theme settings) as a JSON backup, or import a previous backup to restore data.</p>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="rounded-lg bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Export --}}
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Export Backup</h2>
                        <p class="text-sm text-zinc-500">Download a JSON file with all your site content.</p>
                    </div>
                </div>
                <p class="text-xs text-zinc-400 mb-4">Includes: Pages, Blog Posts, Categories, Media, Theme Settings</p>
                <a href="{{ route('admin.backup.export') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download Backup
                </a>
            </div>

            {{-- Import --}}
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Import Backup</h2>
                        <p class="text-sm text-zinc-500">Restore content from a previously exported JSON file.</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.backup.import') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <input type="file" name="backup_file" accept=".json" required class="w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-red-50 dark:file:bg-red-900/20 file:text-red-600 dark:file:text-red-400 hover:file:bg-red-100 dark:hover:file:bg-red-900/40 transition-colors cursor-pointer">
                    </div>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Upload &amp; Import
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>
