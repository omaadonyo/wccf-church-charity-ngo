<section class="py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($data['heading']))
            <div class="text-center mb-12 animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy">{!! $data['heading'] !!}</h2>
            </div>
        @endif
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($data['items'] ?? [] as $item)
                <div class="animate-on-scroll fade-in-up text-center">
                    @if(!empty($item['icon']))
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-red/20 to-red/5 flex items-center justify-center">
                            <svg class="w-7 h-7 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/></svg>
                        </div>
                    @endif
                    <p class="font-heading text-3xl sm:text-4xl font-bold text-navy mb-1 count-up" data-target="{{ $item['value'] }}">0</p>
                    <p class="text-gray-500 text-sm">{{ $item['label'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
