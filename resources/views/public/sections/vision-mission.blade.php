<section class="py-24 relative overflow-hidden" style="background: linear-gradient(135deg, var(--color-navy), var(--color-navy-light));">
    <div class="absolute top-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 animate-on-scroll fade-in-up">
            <span class="text-primary-light font-semibold text-sm tracking-widest uppercase">Our Foundation</span>
            <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white mt-3">What We Believe & Stand For</h2>
            <p class="text-gray-400 mt-4 max-w-2xl mx-auto">The vision and mission that guide every aspect of our fellowship and ministry.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
            <div class="animate-on-scroll fade-in-left group">
                <div class="bg-white rounded-2xl overflow-hidden shadow-xl card-hover">
                    <div class="h-1.5 bg-gradient-to-r from-primary to-primary-light"></div>
                    <div class="p-8 md:p-10">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-navy mb-1">{!! $data['vision_heading'] ?? 'Our Vision' !!}</h3>
                        <div class="w-10 h-0.5 bg-gradient-to-r from-primary to-primary-light rounded-full mb-5"></div>
                        <p class="text-gray-600 leading-relaxed text-lg relative pl-6">
                            <span class="absolute left-0 top-0 text-5xl font-heading font-bold text-primary/15 leading-none -mt-2">&ldquo;</span>
                            {!! $data['vision_content'] ?? '' !!}
                            <span class="text-5xl font-heading font-bold text-primary/15 leading-none align-text-bottom">&rdquo;</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="animate-on-scroll fade-in-right group">
                <div class="bg-white rounded-2xl overflow-hidden shadow-xl card-hover">
                    <div class="h-1.5 bg-gradient-to-r from-primary to-primary-light"></div>
                    <div class="p-8 md:p-10">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary/20 to-primary/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-navy mb-1">{!! $data['mission_heading'] ?? 'Our Mission' !!}</h3>
                        <div class="w-10 h-0.5 bg-gradient-to-r from-primary to-primary-light rounded-full mb-5"></div>
                        <p class="text-gray-600 leading-relaxed text-lg relative pl-6">
                            <span class="absolute left-0 top-0 text-5xl font-heading font-bold text-primary/15 leading-none -mt-2">&ldquo;</span>
                            {!! $data['mission_content'] ?? '' !!}
                            <span class="text-5xl font-heading font-bold text-primary/15 leading-none align-text-bottom">&rdquo;</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
