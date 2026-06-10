<x-layouts::app :title="__('Blog Categories')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Blog Categories</h1>
                <p class="text-sm text-zinc-500 mt-1">Organize your blog posts with categories.</p>
            </div>
            <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">&larr; Back to Posts</a>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800">
                <table class="w-full text-sm">
                    <thead class="bg-zinc-50 dark:bg-zinc-800 border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Name</th>
                            <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Slug</th>
                            <th class="text-center px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Posts</th>
                            <th class="text-end px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @forelse($categories as $cat)
                            <tr>
                                <td class="px-4 py-3 font-medium text-zinc-900 dark:text-white">{{ $cat->name }}</td>
                                <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400 font-mono text-xs">{{ $cat->slug }}</td>
                                <td class="px-4 py-3 text-center text-zinc-500 dark:text-zinc-400">{{ $cat->posts_count }}</td>
                                <td class="px-4 py-3 text-end">
                                    <form method="POST" action="{{ route('admin.blog.categories.update', $cat) }}" class="inline-flex items-center gap-1">
                                        @csrf @method('PUT')
                                        <input type="text" name="name" value="{{ $cat->name }}" class="w-24 px-2 py-1 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-xs">
                                        <input type="text" name="slug" value="{{ $cat->slug }}" class="w-20 px-2 py-1 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-xs">
                                        <button class="px-2 py-1 rounded text-xs text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300">Save</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.blog.categories.destroy', $cat) }}" class="inline" onsubmit="return confirm('Delete this category?')">
                                        @csrf @method('DELETE')
                                        <button class="px-2 py-1 rounded text-xs text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20">Del</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-zinc-500 dark:text-zinc-400">No categories yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Add Category</h2>
                <form method="POST" action="{{ route('admin.blog.categories.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Name *</label>
                        <input type="text" name="name" required class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Slug *</label>
                        <input type="text" name="slug" required class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm">
                    </div>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>
