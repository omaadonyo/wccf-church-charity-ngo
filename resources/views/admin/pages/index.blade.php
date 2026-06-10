<x-layouts::app :title="__('Manage Pages')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Pages</h1>
                <p class="text-sm text-zinc-500 mt-1">Manage your website pages and their content.</p>
            </div>
            <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Page
            </a>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-800 border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Title</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Slug</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Route</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Status</th>
                        <th class="text-end px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($pages as $page)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-white">{{ $page->title }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">/{{ $page->slug }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400 font-mono text-xs">{{ $page->route_name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if($page->published)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Published</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">Draft</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.pages.builder', $page) }}" class="px-3 py-1.5 rounded-md text-xs font-medium bg-red-600 text-white hover:bg-red-700 transition-colors">Builder</a>
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="px-3 py-1.5 rounded-md text-xs font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Settings</a>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Delete this page?')">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1.5 rounded-md text-xs font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-zinc-500 dark:text-zinc-400">No pages yet. <a href="{{ route('admin.pages.create') }}" class="text-red-600 hover:underline">Create one.</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>{{ $pages->links() }}</div>
    </div>
</x-layouts::app>
