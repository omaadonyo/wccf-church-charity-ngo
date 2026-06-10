@php
    $recentPosts = \App\Models\BlogPost::with('category', 'featuredImage')
        ->where('published', true)
        ->latest('published_at')
        ->take($data['limit'] ?? 3)
        ->get();
    $bg = $data['background'] ?? 'wwhite';
    $sectionClass = $bg === 'dark' ? 'bg-navy text-white' : 'bg-wwhite';
@endphp

<section class="py-24 {{ $bg === 'dark' ? 'bg-gradient-to-br from-navy to-navy-light relative overflow-hidden' : 'bg-wwhite' }}">
    @if($bg === 'dark')
        <div class="absolute top-0 left-0 w-96 h-96 bg-red/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        @if($data['heading'] ?? false)
            <div class="text-center mb-12 animate-on-scroll fade-in-up">
                @if($data['subtitle'] ?? false)
                    <span class="text-red font-semibold text-sm tracking-widest uppercase">{{ $data['subtitle'] }}</span>
                @endif
                <h2 class="font-heading text-3xl sm:text-4xl font-bold mt-3 {{ $bg === 'dark' ? 'text-white' : 'text-navy' }}">{!! $data['heading'] !!}</h2>
            </div>
        @endif

        @if($recentPosts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-{{ min($recentPosts->count(), 3) }} gap-8">
                @foreach($recentPosts as $post)
                    <article class="animate-on-scroll fade-in-up bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 card-hover group flex flex-col">
                        <a href="{{ route('news.show', $post->slug) }}" class="block overflow-hidden aspect-[16/10]">
                            @if($post->featuredImage)
                                <img src="{{ $post->featuredImage->url }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-red/10 to-navy/10 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-red/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                </div>
                            @endif
                        </a>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                @if($post->category)
                                    <span class="text-xs font-semibold text-red tracking-wider uppercase">{{ $post->category->name }}</span>
                                    <span class="text-gray-300">·</span>
                                @endif
                                <span class="text-xs text-gray-400">{{ $post->published_at?->format('M d, Y') }}</span>
                            </div>
                            <h3 class="font-heading text-lg font-bold text-navy mb-2 group-hover:text-red transition-colors">
                                <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            @if($post->excerpt)
                                <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-1">{{ $post->excerpt }}</p>
                            @endif
                            <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-red hover:text-red-light transition-colors mt-auto">
                                Read More
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10 animate-on-scroll fade-in-up">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-red text-red font-semibold hover:bg-red hover:text-white transition-all duration-300">
                    View All News
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-gray-400">No posts yet. Check back soon.</p>
            </div>
        @endif
    </div>
</section>
