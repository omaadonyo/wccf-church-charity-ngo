<section class="py-16 md:py-20 @if(($data['background'] ?? 'light') === 'dark') bg-navy text-white @else bg-surface @endif">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center animate-on-scroll fade-in-up">
                @if(!empty($data['label']))
                    <span class="inline-block text-xs font-semibold tracking-[0.2em] uppercase mb-3 @if(($data['background'] ?? 'light') === 'dark') text-red @else text-red @endif">{{ $data['label'] }}</span>
                @endif
                @if(!empty($data['heading']))
                    <h2 class="font-heading text-3xl md:text-4xl font-bold mb-4">{!! $data['heading'] !!}</h2>
                @endif
                @if(!empty($data['subtitle']))
                    <p class="text-sm md:text-base leading-relaxed mb-8 @if(($data['background'] ?? 'light') === 'dark') text-gray-300 @else text-gray-600 @endif">{{ $data['subtitle'] }}</p>
                @endif
            </div>

            <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-lg p-8 md:p-10 animate-on-scroll fade-in-up">
                @if(session('form_success'))
                    <div class="text-center py-8">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">Thank You!</h3>
                        <p class="text-zinc-500 dark:text-zinc-400">{{ session('form_success') }}</p>
                    </div>
                @else
                <form method="POST" action="{{ route('form.submit') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="{{ $data['form_type'] ?? 'volunteer' }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Full Name *</label>
                            <input type="text" name="name" id="name" required class="w-full px-4 py-3 rounded-xl border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="Your full name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Email Address *</label>
                            <input type="email" name="email" id="email" required class="w-full px-4 py-3 rounded-xl border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="your@email.com">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Phone Number</label>
                        <input type="tel" name="phone" id="phone" class="w-full px-4 py-3 rounded-xl border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="+256 ...">
                    </div>

                    @if(($data['show_church_field'] ?? true))
                        <div>
                            <label for="church" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">Home Church / Fellowship</label>
                            <input type="text" name="church" id="church" class="w-full px-4 py-3 rounded-xl border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="Your church or fellowship">
                        </div>
                    @endif

                    <div>
                        <label for="message" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1.5">{{ $data['message_label'] ?? 'Your Message / Why you want to get involved' }}</label>
                        <textarea name="message" id="message" rows="4" class="w-full px-4 py-3 rounded-xl border border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors" placeholder="{{ $data['message_placeholder'] ?? 'Tell us about yourself...' }}"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="w-full px-6 py-3.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-dark transition-colors shadow-lg shadow-primary/20">
                            {{ $data['button_text'] ?? 'Submit Application' }}
                        </button>
                    </div>

                    <p class="text-xs text-zinc-400 text-center">We will never share your personal information with third parties.</p>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
