<x-layouts::app :title="__($page ? 'Edit Page' : 'Create Page')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $page ? 'Edit Page' : 'Create Page' }}</h1>
            <p class="text-sm text-zinc-500 mt-1">{{ $page ? 'Update the page content and settings below.' : 'Fill in the details to create a new page.' }}</p>
        </div>

        <form method="POST" action="{{ $page ? route('admin.pages.update', $page) : route('admin.pages.store') }}" class="max-w-3xl space-y-6">
            @csrf @if($page) @method('PUT') @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" required class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug', $page->slug ?? '') }}" required class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Route Name</label>
                <select name="route_name" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                    <option value="">— None (use slug) —</option>
                    @foreach($pageRoutes as $route)
                        <option value="{{ $route }}" @selected(old('route_name', $page->route_name ?? '') === $route)>{{ $route }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Content (JSON)</label>
                <textarea name="content" rows="12" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm font-mono focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">{{ old('content', $page ? json_encode($page->content, JSON_PRETTY_PRINT) : '{}') }}</textarea>
                <p class="text-xs text-zinc-400 mt-1">Enter page content as JSON. Each section can be a key with its data.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Meta Description</label>
                    <input type="text" name="meta_description" value="{{ old('meta_description', $page->meta_description ?? '') }}" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="hidden" name="published" value="0">
                <input type="checkbox" name="published" value="1" @checked(old('published', $page->published ?? true)) class="rounded border-zinc-300 dark:border-zinc-600 text-red-600 focus:ring-red-500">
                <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Published</label>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">{{ $page ? 'Update Page' : 'Create Page' }}</button>
                <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts::app>
