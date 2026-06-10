<x-layouts::app :title="__('Edit Menu: ' . $menu->name)">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $menu->name }}</h1>
                <p class="text-sm text-zinc-500 mt-1 font-mono">Location: {{ $menu->location }}</p>
            </div>
            <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">&larr; Back</a>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 p-4 text-sm text-green-700 dark:text-green-400 border border-green-200 dark:border-green-800">{{ session('success') }}</div>
        @endif

        <div class="grid lg:grid-cols-2 gap-8">
            {{-- Existing Items --}}
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Menu Items</h2>
                @if($menu->rootItems->count())
                    <div class="space-y-2">
                        @foreach($menu->rootItems as $item)
                            <div class="rounded-lg border border-neutral-200 dark:border-neutral-700 p-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="font-medium text-sm text-zinc-900 dark:text-white">{{ $item->label }}</span>
                                        <span class="text-xs text-zinc-400 font-mono ml-2">{{ $item->route_name ?? $item->url ?? '#' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <form method="POST" action="{{ route('admin.menu-items.update', $item) }}" class="flex items-center gap-1">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="label" value="{{ $item->label }}">
                                            <input type="hidden" name="url" value="{{ $item->url }}">
                                            <input type="hidden" name="route_name" value="{{ $item->route_name }}">
                                            <input type="hidden" name="target" value="{{ $item->target }}">
                                            <input type="number" name="sort_order" value="{{ $item->sort_order }}" class="w-14 px-2 py-1 rounded border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-xs text-center">
                                            <button class="px-2 py-1 rounded text-xs text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300">Save</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.menu-items.destroy', $item) }}" onsubmit="return confirm('Delete this item?')">
                                            @csrf @method('DELETE')
                                            <button class="px-2 py-1 rounded text-xs text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20">Del</button>
                                        </form>
                                    </div>
                                </div>
                                @if($item->children->count())
                                    <div class="ml-6 mt-2 space-y-1 border-l-2 border-zinc-200 dark:border-zinc-700 pl-3">
                                        @foreach($item->children as $child)
                                            <div class="flex items-center justify-between py-1">
                                                <span class="text-sm text-zinc-600 dark:text-zinc-400">{{ $child->label }}</span>
                                                <form method="POST" action="{{ route('admin.menu-items.destroy', $child) }}" onsubmit="return confirm('Delete this item?')">
                                                    @csrf @method('DELETE')
                                                    <button class="text-xs text-red-500 hover:underline">Delete</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-zinc-400">No items yet.</p>
                @endif
            </div>

            {{-- Add Item --}}
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-zinc-800">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Add Item</h2>
                <form method="POST" action="{{ route('admin.menus.items.store', $menu) }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Label *</label>
                        <input type="text" name="label" required class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Route</label>
                        <select name="route_name" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none">
                            <option value="">— Custom URL —</option>
                            @foreach($availableRoutes as $route)
                                <option value="{{ $route }}">{{ $route }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Custom URL</label>
                        <input type="text" name="url" placeholder="https:// or /path" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Parent</label>
                            <select name="parent_id" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none">
                                <option value="">— Top Level —</option>
                                @foreach($menu->rootItems as $item)
                                    <option value="{{ $item->id }}">{{ $item->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Target</label>
                            <select name="target" class="w-full px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-red-500 outline-none">
                                <option value="_self">Same tab</option>
                                <option value="_blank">New tab</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts::app>
