<section class="relative min-h-[50vh] flex items-center overflow-hidden bg-navy">
    <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy-light to-navy"></div>
    @if(!empty($data['image']))
        <div class="absolute inset-0 opacity-30">
            <img src="{{ $data['image'] }}" alt="" class="w-full h-full object-cover">
        </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16 w-full">
        <div class="animate-on-scroll fade-in-up text-center max-w-4xl mx-auto">
            @if(!empty($data['label']))
                <span class="text-red font-semibold text-sm tracking-widest uppercase">{{ $data['label'] }}</span>
            @endif
            <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-4 mb-6">{!! $data['title'] ?? '' !!}</h1>
            @if(!empty($data['subtitle']))
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">{!! $data['subtitle'] !!}</p>
            @endif
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-wwhite to-transparent"></div>
</section>
