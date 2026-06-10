<section class="py-24 relative overflow-hidden" style="background: {{ ($data['background'] ?? 'navy') === 'red' ? 'var(--color-red)' : 'var(--color-navy)' }};">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-on-scroll fade-in-up">
            @if(!empty($data['heading']))
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white mb-6">{!! $data['heading'] !!}</h2>
            @endif
            @if(!empty($data['content']))
                <p class="text-gray-300 text-lg mb-8 max-w-2xl mx-auto">{{ $data['content'] }}</p>
            @endif
            <div class="flex flex-wrap justify-center gap-4">
                @if(!empty($data['button_text']) && !empty($data['button_url']))
                    <a href="{{ $data['button_url'] }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white text-navy font-semibold hover:bg-opacity-90 transition-all">
                        {{ $data['button_text'] }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                @endif
                @if(!empty($data['button_secondary_text']) && !empty($data['button_secondary_url']))
                    <a href="{{ $data['button_secondary_url'] }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-white/30 text-white font-semibold hover:bg-white hover:text-navy transition-all">
                        {{ $data['button_secondary_text'] }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
