<section class="py-24{{ !empty($data['background']) && $data['background'] === 'white' ? ' bg-white' : '' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div class="animate-on-scroll fade-in-left">
                @if(!empty($data['left_label']))
                    <span class="text-red font-semibold text-sm tracking-widest uppercase">{{ $data['left_label'] }}</span>
                @endif
                @if(!empty($data['left_heading']))
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3 mb-6">{!! $data['left_heading'] !!}</h2>
                @endif
                @if(!empty($data['left_content']))
                    <div class="text-gray-600 leading-relaxed prose prose-gray max-w-none">{!! nl2br(e($data['left_content'])) !!}</div>
                @endif
                @if(!empty($data['left_image']))
                    <div class="mt-6 rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ $data['left_image'] }}" alt="" class="w-full aspect-[4/3] object-cover">
                    </div>
                @endif
            </div>
            <div class="animate-on-scroll fade-in-right">
                @if(!empty($data['right_label']))
                    <span class="text-red font-semibold text-sm tracking-widest uppercase">{{ $data['right_label'] }}</span>
                @endif
                @if(!empty($data['right_heading']))
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3 mb-6">{!! $data['right_heading'] !!}</h2>
                @endif
                @if(!empty($data['right_content']))
                    <div class="text-gray-600 leading-relaxed prose prose-gray max-w-none">{!! nl2br(e($data['right_content'])) !!}</div>
                @endif
                @if(!empty($data['right_image']))
                    <div class="mt-6 rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ $data['right_image'] }}" alt="" class="w-full aspect-[4/3] object-cover">
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
