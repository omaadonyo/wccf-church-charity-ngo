<x-layouts::app :title="__('Media Library')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Media Library</h1>
                <p class="text-sm text-zinc-500 mt-1">Upload and manage images and files.</p>
            </div>
            <form method="POST" action="{{ route('admin.media.upload') }}" enctype="multipart/form-data" class="flex items-center gap-3">
                @csrf
                <input type="file" name="file" accept="image/*" required class="text-sm text-zinc-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-red-50 dark:file:bg-red-900/20 file:text-red-600 hover:file:bg-red-100 dark:hover:file:bg-red-900/30">
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">Upload</button>
            </form>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($media as $item)
                <div class="group relative rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800">
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ $item->url }}" alt="{{ $item->alt_text ?: $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="p-2">
                        <p class="text-xs text-zinc-700 dark:text-zinc-300 truncate">{{ $item->name }}</p>
                        <p class="text-xs text-zinc-400">{{ $item->size_formatted }}</p>
                        <p class="text-xs text-zinc-400 font-mono truncate mt-1 bg-zinc-100 dark:bg-zinc-700 rounded p-1 cursor-pointer select-all" title="{{ $item->url }}">{{ $item->url }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.media.destroy', $item) }}" onsubmit="return confirm('Delete this file?')" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf @method('DELETE')
                        <button class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-xs hover:bg-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full rounded-xl border border-neutral-200 dark:border-neutral-700 p-12 text-center text-zinc-500 dark:text-zinc-400">
                    No media uploaded yet.
                </div>
            @endforelse
        </div>
        <div>{{ $media->links() }}</div>
    </div>
</x-layouts::app>
