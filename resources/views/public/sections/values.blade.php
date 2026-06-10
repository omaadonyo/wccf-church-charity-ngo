<section class="py-24 relative overflow-hidden" style="background: linear-gradient(135deg, var(--color-navy), var(--color-navy-light));">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($data['heading']))
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white">{!! $data['heading'] !!}</h2>
                @if(!empty($data['subtitle']))
                    <p class="text-gray-400 mt-4 max-w-2xl mx-auto">{!! $data['subtitle'] !!}</p>
                @endif
            </div>
        @endif
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($data['items'] ?? [] as $item)
                <div class="animate-on-scroll fade-in-up group bg-white/5 border border-white/10 rounded-2xl p-6 card-hover backdrop-blur-sm">
                    @if(!empty($item['icon']))
                        <div class="w-12 h-12 rounded-xl bg-red/10 flex items-center justify-center mb-5 group-hover:bg-red/20 transition-colors">
                            <svg class="w-6 h-6 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/></svg>
                        </div>
                    @endif
                    <h3 class="font-heading text-lg font-semibold text-white mb-2">{{ $item['title'] ?? '' }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $item['desc'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
