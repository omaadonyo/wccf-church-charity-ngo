@extends('layouts.public')

@section('title', 'Get Involved')

@section('content')
    {{-- Hero --}}
    <section class="relative min-h-[50vh] flex items-center overflow-hidden bg-navy">
        <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy-light to-navy"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 50% 50%, rgba(192, 57, 43, 0.07) 0%, transparent 50%), radial-gradient(circle at 20% 80%, rgba(192, 57, 43, 0.05) 0%, transparent 50%);"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16 w-full">
            <div class="animate-on-scroll fade-in-up text-center">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Join Us</span>
                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-4 mb-6">Get Involved</h1>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                    There are many ways to be part of the WCCF community — whether through membership, volunteering, partnership, or prayer.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-wwhite to-transparent"></div>
    </section>

    {{-- Ways to Get Involved --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">How to Participate</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3">Ways to <span class="text-red">Get Involved</span></h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Every hand that reaches out makes a difference. Find your place in the WCCF community.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $ways = [
                        [
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                            'title' => 'Become a Member',
                            'desc' => 'Join one of our 70+ member churches and become part of a vibrant Christian community that fellowships in your own language.',
                            'color' => 'from-red/20 to-red/5',
                            'iconColor' => 'text-red',
                        ],
                        [
                            'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            'title' => 'Volunteer',
                            'desc' => 'Offer your time, skills, and talents to support our various ministries, events, and community outreach programs.',
                            'color' => 'from-red/20 to-red/5',
                            'iconColor' => 'text-red',
                        ],
                        [
                            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                            'title' => 'Attend Events',
                            'desc' => 'Participate in our annual fellowships, conferences, seminars, and special worship gatherings across all member churches.',
                            'color' => 'from-red/20 to-red/5',
                            'iconColor' => 'text-red',
                        ],
                        [
                            'icon' => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z',
                            'title' => 'Partner With Us',
                            'desc' => 'Church organizations, NGOs, and government institutions can partner with WCCF to amplify community development efforts.',
                            'color' => 'from-red/20 to-red/5',
                            'iconColor' => 'text-red',
                        ],
                        [
                            'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                            'title' => 'Give Generously',
                            'desc' => 'Your financial contributions and material support help sustain our ministries and extend charitable assistance to the needy.',
                            'color' => 'from-red/20 to-red/5',
                            'iconColor' => 'text-red',
                        ],
                        [
                            'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                            'title' => 'Pray With Us',
                            'desc' => 'Join our prayer network and intercede for the fellowship, our leaders, member churches, and the community we serve.',
                            'color' => 'from-red/20 to-red/5',
                            'iconColor' => 'text-red',
                        ],
                    ];
                @endphp
                @foreach($ways as $way)
                    <div class="animate-on-scroll fade-in-up group bg-white rounded-2xl p-8 border border-gray-100 card-hover shadow-sm">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $way['color'] }} flex items-center justify-center mb-5">
                            <svg class="w-7 h-7 {{ $way['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $way['icon'] }}"/></svg>
                        </div>
                        <h3 class="font-heading text-xl font-semibold text-navy mb-3">{{ $way['title'] }}</h3>
                        <p class="text-gray-500 leading-relaxed text-sm">{{ $way['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Become a Member CTA --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red/5 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="animate-on-scroll fade-in-left">
                    <span class="text-red font-semibold text-sm tracking-widest uppercase">Membership</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3 mb-6">
                        Join a <span class="text-red">Fellowship</span> That Speaks Your Language
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        One of the core objectives of WCCF is to unite the West Nile community in diaspora to fellowship in their own languages. Language should never be a barrier to worship.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        With over 70 member churches across Buganda, Busoga, and Bunyoro regions, there's a WCCF community near you. Contact us to find a member church or start a fellowship in your area.
                    </p>
                    <a href="{{ route('donate') }}" class="btn-primary">
                        Contact Us About Membership
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="animate-on-scroll fade-in-right">
                    <div class="bg-wwhite rounded-2xl p-8 border border-gray-100">
                        <h3 class="font-heading text-xl font-semibold text-navy mb-6">Benefits of Membership</h3>
                        <div class="space-y-4">
                            @php
                                $benefits = [
                                    'Fellowship in your native language',
                                    'Access to all WCCF events and conferences',
                                    'Pastoral care and spiritual guidance',
                                    'Community support network',
                                    'Opportunities to serve and lead',
                                    'Connection to 70+ member churches',
                                ];
                            @endphp
                            @foreach($benefits as $benefit)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red/20 to-red/5 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="text-gray-600 text-sm">{{ $benefit }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Upcoming Events Preview --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-navy to-navy-light"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white">Upcoming <span class="text-red">Events</span></h2>
                <p class="text-gray-400 mt-4 max-w-2xl mx-auto">Stay connected with the WCCF community through our gatherings and programs.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @php
                    $events = [
                        ['title' => 'Annual Fellowship Conference', 'date' => 'August 15-17, 2026', 'location' => 'Kampala, Uganda', 'desc' => 'Our flagship annual gathering bringing together all member churches for worship, teaching, and fellowship.'],
                        ['title' => 'Leadership Development Workshop', 'date' => 'October 10, 2026', 'location' => 'St. Francis Chapel, Makerere', 'desc' => 'Equipping church leaders with practical skills for effective ministry and community service.'],
                        ['title' => 'Youth Revival & Empowerment', 'date' => 'December 5-7, 2026', 'location' => 'St. Paul Church, Okuvu', 'desc' => 'A special program designed to inspire and empower the next generation of Christian leaders.'],
                    ];
                @endphp
                @foreach($events as $event)
                    <div class="animate-on-scroll fade-in-up bg-white/5 border border-white/10 rounded-2xl p-6 card-hover backdrop-blur-sm">
                        <div class="flex items-center gap-2 text-red text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-sm">{{ $event['date'] }}</span>
                        </div>
                        <h3 class="font-heading text-lg font-semibold text-white mb-2">{{ $event['title'] }}</h3>
                        <p class="text-gray-400 text-sm mb-3">{{ $event['desc'] }}</p>
                        <div class="flex items-center gap-1 text-gray-500 text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $event['location'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mb-6">
                    Ready to <span class="text-red">Get Started?</span>
                </h2>
                <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                    Take the first step toward becoming part of a vibrant Christian community. Reach out to us today.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('donate') }}" class="btn-primary">
                        Support Our Mission
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="mailto:info@wccfuganda.org" class="btn-outline border-navy text-navy hover:bg-navy hover:text-white">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
