<x-layouts::app :title="__('Manage Menus')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Menus</h1>
            <p class="text-sm text-zinc-500 mt-1">Manage navigation menus across your website.</p>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <div class="grid gap-6">
            @forelse($menus as $menu)
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ $menu->name }}</h2>
                            <p class="text-xs text-zinc-500 font-mono">Location: {{ $menu->location }}</p>
                        </div>
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">Manage Items</a>
                    </div>

                    @if($menu->rootItems->count())
                        <ul class="space-y-1">
                            @foreach($menu->rootItems as $item)
                                <li class="flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400 py-1">
                                    <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                    <span>{{ $item->label }}</span>
                                    <span class="text-xs text-zinc-400 font-mono">{{ $item->route_name ?? $item->url ?? '#' }}</span>
                                    @if($item->children->count())
                                        <span class="text-xs text-zinc-400">({{ $item->children->count() }} sub-items)</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-zinc-400">No items in this menu.</p>
                    @endif
                </div>
            @empty
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-8 text-center text-zinc-500 dark:text-zinc-400">
                    No menus defined. Add menus via seeder or database.
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>
