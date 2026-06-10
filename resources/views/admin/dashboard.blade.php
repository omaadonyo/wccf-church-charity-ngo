<x-layouts::app :title="__('Admin Dashboard')">
    @push('head')
    <style>
        .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(86,5,52,0.15); }
        .stat-card .stat-icon { transition: all 0.3s; }
        .stat-card:hover .stat-icon { transform: scale(1.1) rotate(-5deg); }
        .activity-timeline { position: relative; }
        .activity-timeline::before { content: ''; position: absolute; left: 11px; top: 8px; bottom: 8px; width: 2px; background: linear-gradient(to bottom, #560534, #8c2355, transparent); }
        .activity-dot { width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; flex-shrink: 0; position: relative; z-index: 1; border: 2px solid white; }
        .glass-card { background: rgba(255,255,255,0.7); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        .dark .glass-card { background: rgba(24,24,27,0.7); }
        .value-up { color: #16a34a; }
        .stat-gradient-1 { background: linear-gradient(135deg, #560534 0%, #8c2355 100%); }
        .stat-gradient-2 { background: linear-gradient(135deg, #0f1b2d 0%, #1a2d4a 100%); }
        .stat-gradient-3 { background: linear-gradient(135deg, #1a5276 0%, #2e86c1 100%); }
        .stat-gradient-4 { background: linear-gradient(135deg, #6c3483 0%, #a569bd 100%); }
        .stat-gradient-5 { background: linear-gradient(135deg, #1e8449 0%, #27ae60 100%); }
        .stat-gradient-6 { background: linear-gradient(135deg, #b9770e 0%, #f39c12 100%); }
        .mini-chart { display: flex; align-items: flex-end; gap: 3px; height: 40px; }
        .mini-chart .bar { width: 8px; border-radius: 4px 4px 0 0; background: rgba(255,255,255,0.3); transition: height 0.5s ease; }
        .mini-chart .bar:nth-child(1) { height: 24px; }
        .mini-chart .bar:nth-child(2) { height: 32px; }
        .mini-chart .bar:nth-child(3) { height: 18px; }
        .mini-chart .bar:nth-child(4) { height: 40px; }
        .mini-chart .bar:nth-child(5) { height: 28px; }
        .mini-chart .bar:nth-child(6) { height: 36px; }
        .mini-chart .bar:nth-child(7) { height: 20px; }
        .page-view-bar { transition: all 0.3s; }
        .page-view-bar:hover { opacity: 0.8; transform: scaleY(1.05); }
    </style>
    @endpush

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6 overflow-y-auto">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Dashboard</h1>
                <p class="text-sm text-zinc-500 mt-1">Here's what's happening with your site today.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-xs text-zinc-500">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    {{ $activeSessions }} active
                </div>
                <div class="text-xs text-zinc-400">{{ now()->format('l, F j, Y') }}</div>
            </div>
        </div>

        {{-- Stat Cards Row --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
            <div class="stat-card stat-gradient-1 rounded-xl p-5 text-white cursor-pointer">
                <div class="flex items-start justify-between mb-3">
                    <div class="stat-icon w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold mb-0.5">{{ $totalUsers }}</p>
                <p class="text-xs text-white/70">Total Users</p>
                <div class="mt-2 text-[10px] text-white/50">{{ $activeSessions }} currently online</div>
            </div>

            <a href="{{ route('admin.pages.index') }}" class="stat-card stat-gradient-2 rounded-xl p-5 text-white cursor-pointer">
                <div class="flex items-start justify-between mb-3">
                    <div class="stat-icon w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold mb-0.5">{{ $totalPages }}</p>
                <p class="text-xs text-white/70">Pages</p>
                <div class="mt-2 text-[10px] text-white/50">Manage content &rarr;</div>
            </a>

            <a href="{{ route('admin.blog.index') }}" class="stat-card stat-gradient-3 rounded-xl p-5 text-white cursor-pointer">
                <div class="flex items-start justify-between mb-3">
                    <div class="stat-icon w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold mb-0.5">{{ $totalBlogPosts }}</p>
                <p class="text-xs text-white/70">Blog Posts</p>
                <div class="mt-2 text-[10px] text-white/50">Write new post &rarr;</div>
            </a>

            <a href="{{ route('admin.media.index') }}" class="stat-card stat-gradient-4 rounded-xl p-5 text-white cursor-pointer">
                <div class="flex items-start justify-between mb-3">
                    <div class="stat-icon w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold mb-0.5">{{ $totalMedia }}</p>
                <p class="text-xs text-white/70">Media Files</p>
                <div class="mt-2 text-[10px] text-white/50">Upload new &rarr;</div>
            </a>

            <div class="stat-card stat-gradient-5 rounded-xl p-5 text-white cursor-pointer">
                <div class="flex items-start justify-between mb-3">
                    <div class="stat-icon w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold mb-0.5">{{ $totalPageViews }}</p>
                <p class="text-xs text-white/70">Total Page Views</p>
                <div class="mt-2 flex gap-2 text-[10px]">
                    <span class="text-white/70">{{ $pageViewsToday }} today</span>
                    <span class="text-white/50">|</span>
                    <span class="text-white/70">{{ $pageViewsLastWeek }} this week</span>
                </div>
            </div>

            <div class="stat-card stat-gradient-6 rounded-xl p-5 text-white cursor-pointer">
                <div class="flex items-start justify-between mb-3">
                    <div class="stat-icon w-10 h-10 rounded-xl bg-white/15 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold mb-0.5">{{ $totalActivities }}</p>
                <p class="text-xs text-white/70">Activity Logs</p>
                <div class="mt-2 mini-chart">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </div>

        {{-- Bottom Grid: Activity Log + Top Pages + Recent Users --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Activity Log --}}
            <div class="lg:col-span-2 rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-zinc-700">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <h3 class="font-semibold text-sm text-zinc-900 dark:text-white">Recent Activity</h3>
                    </div>
                    <span class="text-xs text-zinc-400">{{ $totalActivities }} total events</span>
                </div>
                <div class="divide-y divide-zinc-100 dark:divide-zinc-700/50 max-h-[400px] overflow-y-auto">
                    @forelse($recentActivities as $log)
                        <div class="flex items-start gap-3 px-5 py-3 hover:bg-zinc-50 dark:hover:bg-zinc-700/30 transition-colors">
                            <div class="activity-dot
                                @php
                                    $colors = ['bg-red-500', 'bg-blue-500', 'bg-purple-500', 'bg-green-500', 'bg-amber-500', 'bg-cyan-500'];
                                    $colorMap = ['page_' => 'bg-blue-500', 'blog_' => 'bg-purple-500', 'media_' => 'bg-green-500', 'theme_' => 'bg-amber-500', 'menu_' => 'bg-cyan-500', 'category_' => 'bg-pink-500', 'user_' => 'bg-red-500', 'system_' => 'bg-zinc-500'];
                                    $color = 'bg-zinc-400';
                                    foreach ($colorMap as $prefix => $c) { if (str_starts_with($log->action, $prefix)) { $color = $c; break; } }
                                @endphp
                                {{ $color }}">
                                @php
                                    $icons = ['page_' => 'P', 'blog_' => 'B', 'media_' => 'M', 'theme_' => 'T', 'menu_' => 'N', 'category_' => 'C', 'user_' => 'U', 'system_' => 'S'];
                                    $icon = '•';
                                    foreach ($icons as $prefix => $i) { if (str_starts_with($log->action, $prefix)) { $icon = $i; break; } }
                                @endphp
                                {{ $icon }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-medium text-zinc-900 dark:text-white capitalize">{{ str_replace('_', ' ', $log->action) }}</span>
                                    <span class="text-[10px] text-zinc-400">{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                                @if($log->description)
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5 truncate">{{ $log->description }}</p>
                                @endif
                                @if($log->user)
                                    <p class="text-[10px] text-zinc-400 mt-0.5">{{ $log->user->name }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-8 text-center text-sm text-zinc-400">No activity recorded yet.</div>
                    @endforelse
                </div>
            </div>

            {{-- Right Column: Top Pages + Recent Users --}}
            <div class="flex flex-col gap-6">
                {{-- Top Pages --}}
                <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-zinc-700">
                        <h3 class="font-semibold text-sm text-zinc-900 dark:text-white">Top Pages</h3>
                        <span class="text-xs text-zinc-400">{{ $totalPageViews }} views</span>
                    </div>
                    <div class="p-4 space-y-3">
                        @forelse($topPages as $page)
                            <div class="group">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs font-medium text-zinc-700 dark:text-zinc-300 truncate max-w-[70%]">/{{ $page->url }}</span>
                                    <span class="text-xs font-semibold text-zinc-900 dark:text-white">{{ $page->total }}</span>
                                </div>
                                <div class="w-full h-1.5 rounded-full bg-zinc-100 dark:bg-zinc-700 overflow-hidden">
                                    @php $width = min(100, ($page->total / max(1, $topPages->first()->total)) * 100); @endphp
                                    <div class="page-view-bar h-full rounded-full" style="width: {{ $width }}%; background: linear-gradient(90deg, #560534, #8c2355);"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-sm text-zinc-400 py-4">No page views yet.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Users --}}
                <div class="rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-zinc-700">
                        <h3 class="font-semibold text-sm text-zinc-900 dark:text-white">Recent Users</h3>
                        <span class="text-xs text-zinc-400">{{ $totalUsers }} total</span>
                    </div>
                    <div class="divide-y divide-zinc-100 dark:divide-zinc-700/50">
                        @forelse($recentUsers as $user)
                            <div class="flex items-center gap-3 px-5 py-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ $user->initials() }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-zinc-900 dark:text-white truncate">{{ $user->name }}</p>
                                    <p class="text-xs text-zinc-400 truncate">{{ $user->email }}</p>
                                </div>
                                <span class="text-[10px] text-zinc-400">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="px-5 py-8 text-center text-sm text-zinc-400">No users yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
