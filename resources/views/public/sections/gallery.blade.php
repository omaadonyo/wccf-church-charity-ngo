<section class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/[0.03] rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/[0.03] rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($data['heading']))
            <div class="text-center mb-14 animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy">{!! $data['heading'] !!}</h2>
                @if(!empty($data['subtitle']))
                    <p class="text-gray-500 mt-3 max-w-2xl mx-auto">{!! $data['subtitle'] !!}</p>
                @endif
            </div>
        @endif
        <div class="columns-2 sm:columns-3 lg:columns-4 gap-5 space-y-5">
            @foreach($data['images'] ?? [] as $i => $img)
                <div class="animate-on-scroll fade-in-up break-inside-avoid overflow-hidden rounded-xl shadow-md group relative" style="transition-delay: {{ $i * 0.05 }}s">
                    <div class="relative overflow-hidden">
                        <img src="{{ $img }}" alt="" class="w-full object-cover transition-all duration-700 group-hover:scale-110" loading="lazy" style="aspect-ratio: {{ [4/3, 1/1, 3/4, 16/9, 4/3, 1/1, 3/4, 16/9][$i % 8] }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy/70 via-navy/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex items-center justify-center w-10 h-10 mx-auto rounded-full bg-white/20 backdrop-blur-sm">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
