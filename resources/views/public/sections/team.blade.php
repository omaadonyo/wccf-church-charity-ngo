@php $isDark = ($data['background'] ?? 'wwhite') === 'dark'; @endphp
<section class="py-24 {{ $isDark ? 'bg-navy relative overflow-hidden' : 'bg-wwhite' }}">
    @if($isDark)
        <div class="absolute top-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>
    @endif
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($data['heading']) || !empty($data['subtitle']))
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                @if(!empty($data['subtitle']))
                    <span class="text-primary font-semibold text-sm tracking-widest uppercase">{{ $data['subtitle'] }}</span>
                @endif
                @if(!empty($data['heading']))
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold {{ $isDark ? 'text-white' : 'text-navy' }} mt-3">{!! $data['heading'] !!}</h2>
                @endif
            </div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($data['items'] ?? [] as $item)
                <div class="animate-on-scroll fade-in-up group {{ $isDark ? 'bg-white/5 border-white/10' : 'bg-white border-gray-100' }} rounded-2xl overflow-hidden border card-hover">
                    <div class="aspect-[4/5] overflow-hidden relative" @if(!$isDark) style="background: color-mix(in srgb, var(--color-primary) 3%, transparent)" @else style="background: color-mix(in srgb, var(--color-primary) 10%, transparent)" @endif>
                        @if(!empty($item['photo']))
                            <img src="{{ $item['photo'] }}" alt="{{ $item['name'] ?? '' }}" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 {{ $isDark ? 'text-white/20' : 'text-navy/10' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-400" @if($isDark) style="background: linear-gradient(to top, color-mix(in srgb, var(--color-navy) 80%, transparent) 0%, transparent 50%)" @else style="background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 50%)" @endif></div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-heading text-lg font-bold {{ $isDark ? 'text-white' : 'text-navy' }}">{{ $item['name'] ?? '' }}</h3>
                        <p class="text-primary font-medium text-sm mt-0.5">{{ $item['role'] ?? '' }}</p>
                        @if(!empty($item['bio']))
                            <p class="{{ $isDark ? 'text-gray-400' : 'text-gray-500' }} text-sm leading-relaxed mt-3">{{ $item['bio'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>