<section class="hero-slider relative h-screen overflow-hidden">
    @foreach($data['slides'] ?? [] as $i => $slide)
        <div class="hero-slide {{ $i === 0 ? 'active' : '' }}">
            <img src="{{ $slide['image'] ?? '' }}" alt="Slide {{ $i + 1 }}" class="w-full h-full object-cover" style="animation: ken-burns 12s ease-in-out infinite alternate;">
            <div class="hero-overlay"></div>
        </div>
    @endforeach

    <div class="relative z-10 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-24">
            <div class="max-w-3xl hero-content">
                @if(!empty($data['badge_text']))
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white/90 text-sm mb-6 backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-red animate-pulse-soft"></span>
                        {{ $data['badge_text'] }}
                    </div>
                @endif
                @if(!empty($data['slides'][0]['title']))
                    <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight mb-6">
                        <span class="shimmer-text">WCCF</span><br>
                        <span id="hero-title">{{ $data['slides'][0]['title'] }}</span>
                    </h1>
                @endif
                @if(!empty($data['slides'][0]['subtitle']))
                    <p class="text-gray-200 text-lg sm:text-xl leading-relaxed max-w-xl mb-8" id="hero-subtitle">
                        {{ $data['slides'][0]['subtitle'] }}
                    </p>
                @endif
                <div class="flex flex-wrap gap-4">
                    @if(!empty($data['button_primary_text']) && !empty($data['button_primary_url']))
                        <a href="{{ $data['button_primary_url'] }}" class="btn-primary text-base" style="background: linear-gradient(135deg, var(--color-red), var(--color-red-light)); color: white;">
                            {{ $data['button_primary_text'] }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif
                    @if(!empty($data['button_secondary_text']) && !empty($data['button_secondary_url']))
                        <a href="{{ $data['button_secondary_url'] }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-white/30 text-white font-semibold hover:bg-white hover:text-navy transition-all duration-300">
                            {{ $data['button_secondary_text'] }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-10 left-0 right-0 z-10 flex justify-center gap-3">
        @foreach($data['slides'] ?? [] as $i => $slide)
            <button class="slider-dot {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}" aria-label="Slide {{ $i + 1 }}"></button>
        @endforeach
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-wwhite to-transparent z-10"></div>
</section>
