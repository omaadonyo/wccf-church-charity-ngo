@extends('layouts.public')

@section('title', 'Donate')

@section('content')
    {{-- Hero --}}
    <section class="relative min-h-[50vh] flex items-center overflow-hidden bg-navy">
        <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy-light to-navy"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 50% 40%, color-mix(in srgb, var(--color-primary) 8%, transparent) 0%, transparent 50%), radial-gradient(circle at 80% 60%, color-mix(in srgb, var(--color-primary) 6%, transparent) 0%, transparent 50%);"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16 w-full">
            <div class="animate-on-scroll fade-in-up text-center">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Support Our Mission</span>
                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-4 mb-6">Make a <span class="text-red">Donation</span></h1>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                    Your generous giving enables WCCF to continue uniting the West Nile community in faith, providing spiritual nourishment, and extending charitable assistance to those in need.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-wwhite to-transparent"></div>
    </section>

    {{-- Giving Options --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Give</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3">Ways to <span class="text-red">Give</span></h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Every contribution — no matter the size — makes an eternal impact in the lives of God's people.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 mb-16">
                @php
                    $methodIcon1 = 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z';
                    $methodIcon2 = 'M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4';
                    $methodIcon3 = 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z';
                @endphp
                @foreach([
                    ['icon' => $methodIcon1, 'title' => 'Bank Transfer', 'details' => ['Bank: Stanbic Bank Uganda', 'Account Name: WCCF Ltd', 'Account No: 9030001234567', 'Branch: Kampala Main', 'Swift Code: SBICUGKX']],
                    ['icon' => $methodIcon2, 'title' => 'Mobile Money', 'details' => ['MTN: +256 700 000 000', 'Airtel: +256 700 000 001', 'Name: WCCF Ltd', 'All networks accepted']],
                    ['icon' => $methodIcon3, 'title' => 'Online Giving', 'details' => ['PayPal: Coming Soon', 'Credit/Debit Cards', 'Secure online portal', 'Instant confirmation']],
                ] as $method)
                    <div class="animate-on-scroll fade-in-up bg-white rounded-2xl p-8 border border-gray-100 card-hover shadow-sm">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red/20 to-red/5 flex items-center justify-center mb-5">
                            <svg class="w-7 h-7 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $method['icon'] }}"/></svg>
                        </div>
                        <h3 class="font-heading text-xl font-semibold text-navy mb-4">{{ $method['title'] }}</h3>
                        <ul class="space-y-2">
                            @foreach($method['details'] as $detail)
                                <li class="flex items-start gap-2 text-gray-600 text-sm">
                                    <svg class="w-4 h-4 text-red mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    {{ $detail }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Impact of Giving --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute left-0 bottom-0 w-80 h-80 bg-red/5 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="animate-on-scroll fade-in-left">
                    <span class="text-red font-semibold text-sm tracking-widest uppercase">Your Impact</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3 mb-6">
                        Where Your <span class="text-red">Gift Goes</span>
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Your donations directly support the ministries and programs that serve the West Nile Christian community. We are committed to transparency and faithful stewardship of every contribution.
                    </p>
                    <div class="space-y-4">
                        @php
                            $impacts = [
                                ['title' => 'Worship & Fellowship Programs', 'pct' => '35%', 'desc' => 'Supporting annual conferences, departmental fellowships, and worship gatherings.'],
                                ['title' => 'Community Outreach & Charity', 'pct' => '30%', 'desc' => 'Providing relief, medical assistance, and educational support to the needy.'],
                                ['title' => 'Church Support & Development', 'pct' => '20%', 'desc' => 'Strengthening member churches through resources, training, and capacity building.'],
                                ['title' => 'Administration & Operations', 'pct' => '15%', 'desc' => 'Ensuring efficient management, database systems, and organizational sustainability.'],
                            ];
                        @endphp
                        @foreach($impacts as $item)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-medium text-navy">{{ $item['title'] }}</span>
                                    <span class="text-red font-semibold">{{ $item['pct'] }}</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-red to-red-light h-2 rounded-full" style="width: {{ $item['pct'] }}"></div>
                                </div>
                                <p class="text-gray-400 text-xs mt-1">{{ $item['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="animate-on-scroll fade-in-right">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1593113630400-ea4288922497?w=800&q=80" alt="Community impact" class="w-full aspect-[4/3] object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Giving Form --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-navy to-navy-light"></div>
        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white">Make a <span class="text-red">Donation</span></h2>
                <p class="text-gray-400 mt-4">Fill out the form below and we will get back to you with payment instructions.</p>
            </div>

            <div class="animate-on-scroll fade-in-up bg-white rounded-2xl p-8 md:p-10 shadow-xl">
                <form class="space-y-6">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-navy mb-2">Full Name *</label>
                            <input type="text" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-wwhite focus:border-red focus:ring-2 focus:ring-red/20 outline-none transition-all text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-navy mb-2">Email Address *</label>
                            <input type="email" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-wwhite focus:border-red focus:ring-2 focus:ring-red/20 outline-none transition-all text-sm">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-navy mb-2">Phone Number</label>
                            <input type="tel" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-wwhite focus:border-red focus:ring-2 focus:ring-red/20 outline-none transition-all text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-navy mb-2">Giving Method *</label>
                            <select required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-wwhite focus:border-red focus:ring-2 focus:ring-red/20 outline-none transition-all text-sm">
                                <option value="">Select method</option>
                                <option>Bank Transfer</option>
                                <option>Mobile Money</option>
                                <option>Online Payment</option>
                                <option>Cash/In-Person</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-navy mb-2">Amount (UGX) *</label>
                        <div class="grid grid-cols-4 gap-3 mb-3">
                            @php $amounts = ['50,000', '100,000', '250,000', '500,000'] @endphp
                            @foreach($amounts as $amt)
                                <button type="button" class="amount-btn px-4 py-3 rounded-xl border border-gray-200 text-sm font-medium text-gray-600 hover:border-red hover:text-red transition-all">
                                    UGX {{ $amt }}
                                </button>
                            @endforeach
                        </div>
                        <input type="number" placeholder="Or enter custom amount" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-wwhite focus:border-red focus:ring-2 focus:ring-red/20 outline-none transition-all text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-navy mb-2">Giving Purpose</label>
                        <select class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-wwhite focus:border-red focus:ring-2 focus:ring-red/20 outline-none transition-all text-sm">
                            <option>General Fund</option>
                            <option>Community Outreach</option>
                            <option>Church Support</option>
                            <option>Youth Programs</option>
                            <option>Conference & Events</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-navy mb-2">Message (Optional)</label>
                        <textarea rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-wwhite focus:border-red focus:ring-2 focus:ring-red/20 outline-none transition-all text-sm resize-none"></textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center text-base py-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Complete Your Gift
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- Stewardship --}}
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mb-6">
                    Faithful <span class="text-red">Stewardship</span>
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed max-w-3xl mx-auto mb-8">
                    WCCF is committed to the highest standards of financial integrity and transparency. As a registered company limited by guarantee (Registration No. 80020002936115), we ensure every gift is used responsibly to further the Kingdom of God and serve the West Nile Christian community.
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    <span class="px-4 py-2 rounded-full bg-green-50 text-green-700 text-sm font-medium">Tax-Exempt Status</span>
                    <span class="px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium">Registered NGO</span>
                    <span class="px-4 py-2 rounded-full bg-red-50 text-red-700 text-sm font-medium">Financial Transparency</span>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 bg-navy relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy-light to-navy"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="font-heading text-2xl sm:text-3xl font-bold text-white mb-4">
                    Have Questions About Giving?
                </h2>
                <p class="text-gray-300 mb-6">We would love to hear from you. Reach out to our stewardship team.</p>
                <a href="mailto:info@wccfuganda.org" class="btn-outline border-white/30 text-white hover:bg-white hover:text-navy">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Email Us
                </a>
            </div>
        </div>
    </section>
@endsection
