<section class="py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-on-scroll fade-in-up max-w-4xl mx-auto">
            @if(!empty($data['label']))
                <span class="text-red font-semibold text-sm tracking-widest uppercase">{{ $data['label'] }}</span>
            @endif
            @if(!empty($data['heading']))
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3 mb-6">{!! $data['heading'] !!}</h2>
            @endif
            @if(!empty($data['content']))
                <div class="text-gray-600 leading-relaxed text-lg prose prose-gray max-w-none">{!! nl2br(e($data['content'])) !!}</div>
            @endif
        </div>
    </div>
</section>
