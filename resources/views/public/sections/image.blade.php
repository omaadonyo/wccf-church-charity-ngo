<section class="py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="animate-on-scroll fade-in-up max-w-4xl mx-auto">
            <div class="rounded-2xl overflow-hidden shadow-xl">
                <img src="{{ $data['src'] ?? '' }}" alt="{{ $data['alt'] ?? '' }}" class="w-full h-auto object-cover">
            </div>
            @if(!empty($data['caption']))
                <p class="text-center text-gray-500 text-sm mt-3">{{ $data['caption'] }}</p>
            @endif
        </div>
    </div>
</section>
