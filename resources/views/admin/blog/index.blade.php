<x-layouts::app :title="__('Manage Blog')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Blog Posts</h1>
                <p class="text-sm text-zinc-500 mt-1">Manage your blog posts and articles.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.blog.categories') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Categories</a>
                <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Post
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <div class="overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-800 border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400 w-12">Image</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Title</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Category</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Author</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Status</th>
                        <th class="text-start px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Date</th>
                        <th class="text-end px-4 py-3 font-medium text-zinc-500 dark:text-zinc-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($posts as $post)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                            <td class="px-4 py-3">
                                @if($post->featuredImage)
                                    <img src="{{ $post->featuredImage->url }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-zinc-300 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.41a2.25 2.25 0 013.182 0l2.909 2.91m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-white">{{ $post->title }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $post->category->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $post->author->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if($post->published)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Published</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">Draft</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400 text-xs">{{ $post->published_at?->format('M j, Y') ?? $post->created_at->format('M j, Y') }}</td>
                            <td class="px-4 py-3 text-end">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.blog.edit', $post) }}" class="px-3 py-1.5 rounded-md text-xs font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Edit</a>
                                    <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1.5 rounded-md text-xs font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-zinc-500 dark:text-zinc-400">No posts yet. <a href="{{ route('admin.blog.create') }}" class="text-red-600 hover:underline">Create one.</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>{{ $posts->links() }}</div>
    </div>
</x-layouts::app>
