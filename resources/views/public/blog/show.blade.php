@extends('layouts.public')

@section('title', $post->title)

@section('navbarTransparent', 'false')
@section('navbarExtra', 'navbar-solid')

@section('content')
    <article>
        @if($post->featuredImage)
            <section class="relative h-[50vh] min-h-[400px] overflow-hidden">
                <img src="{{ $post->featuredImage->url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-navy/80 via-navy/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                    <div class="flex items-center gap-3 mb-3">
                        @if($post->category)
                            <span class="text-xs font-semibold text-red tracking-wider uppercase bg-white/10 px-3 py-1 rounded-full">{{ $post->category->name }}</span>
                        @endif
                        <span class="text-xs text-gray-300">{{ $post->published_at?->format('F d, Y') }}</span>
                    </div>
                    <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">{{ $post->title }}</h1>
                </div>
            </section>
        @else
            <section class="pt-40 pb-16 bg-gradient-to-br from-navy to-navy-light relative overflow-hidden">
                <div class="absolute top-0 right-0 w-96 h-96 bg-red/10 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        @if($post->category)
                            <span class="text-xs font-semibold text-red tracking-wider uppercase">{{ $post->category->name }}</span>
                            <span class="text-gray-600">·</span>
                        @endif
                        <span class="text-xs text-gray-400">{{ $post->published_at?->format('F d, Y') }}</span>
                    </div>
                    <h1 class="font-heading text-4xl sm:text-5xl font-bold text-white leading-tight">{{ $post->title }}</h1>
                    @if($post->excerpt)
                        <p class="text-gray-400 text-lg mt-4 max-w-2xl">{{ $post->excerpt }}</p>
                    @endif
                </div>
            </section>
        @endif

        <section class="py-16 bg-wwhite">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($post->author || ($post->excerpt && !$post->featuredImage))
                    <div class="flex items-center gap-4 mb-10 pb-8 border-b border-gray-100">
                        @if($post->author)
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-red to-red-light flex items-center justify-center text-white font-heading font-bold">
                                {{ strtoupper(substr($post->author->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-navy">{{ $post->author->name }}</p>
                                <p class="text-xs text-gray-400">{{ $post->published_at?->format('F d, Y') }} · {{ $post->published_at?->diffForHumans() }}</p>
                            </div>
                        @endif
                        @if($post->excerpt && !$post->featuredImage)
                            <p class="text-gray-500 italic flex-1 ml-4 pl-4 border-l border-gray-200">{{ $post->excerpt }}</p>
                        @endif
                    </div>
                @endif

                <div class="prose prose-lg max-w-none blog-content">
                    {!! $post->content !!}
                </div>

                @if($recent->count() > 0)
                    <div class="mt-16 pt-12 border-t border-gray-100">
                        <h3 class="font-heading text-2xl font-bold text-navy mb-8">Recent Posts</h3>
                        <div class="grid sm:grid-cols-3 gap-6">
                            @foreach($recent as $r)
                                <a href="{{ route('news.show', $r->slug) }}" class="group block">
                                    <div class="aspect-[16/10] rounded-xl overflow-hidden mb-3 bg-gray-100">
                                        @if($r->featuredImage)
                                            <img src="{{ $r->featuredImage->url }}" alt="{{ $r->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-red/5 to-navy/5 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="font-heading font-semibold text-navy group-hover:text-red transition-colors text-sm">{{ $r->title }}</h4>
                                    <p class="text-xs text-gray-400 mt-1">{{ $r->published_at?->format('M d, Y') }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </article>
@endsection
