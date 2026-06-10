@extends('layouts.public')

@section('title', 'Home')

@section('navbarTransparent', 'true')
@section('navbarExtra', 'navbar-transparent')

@section('content')
    {{-- Hero Slider --}}
    <section class="hero-slider relative h-screen overflow-hidden">
        @php
            $slides = [
                [
                    'img' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=1600&q=80',
                    'title' => 'Uniting the West Nile Community in Faith',
                    'subtitle' => 'West Nile Christian Community Fellowship — a faith-based community promoting renewed, healed, and prayerful Christians across Uganda and beyond.',
                ],
                [
                    'img' => 'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=1600&q=80',
                    'title' => 'Worship Together, Grow Together',
                    'subtitle' => 'Over 70 member churches united in fellowship, worship, and service across Buganda, Busoga and Bunyoro regions.',
                ],
                [
                    'img' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=1600&q=80',
                    'title' => 'Serving the Needy, Uplifting Communities',
                    'subtitle' => 'Extending Christ\'s love through charitable assistance, medical outreach, and community development programs.',
                ],
            ];
        @endphp

        @foreach($slides as $i => $slide)
            <div class="hero-slide {{ $i === 0 ? 'active' : '' }}">
                <img src="{{ $slide['img'] }}" alt="Slide {{ $i + 1 }}" class="w-full h-full object-cover" style="animation: ken-burns 12s ease-in-out infinite alternate;">
                <div class="hero-overlay"></div>
            </div>
        @endforeach

        <div class="relative z-10 h-full flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-24">
                <div class="max-w-3xl hero-content">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white/90 text-sm mb-6 backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-red animate-pulse-soft"></span>
                        Uganda Registration No. 80020002936115
                    </div>
                    <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight mb-6">
                        <span class="shimmer-text">WCCF</span>
                        <br>
                        <span id="hero-title">{{ $slides[0]['title'] }}</span>
                    </h1>
                    <p class="text-gray-200 text-lg sm:text-xl leading-relaxed max-w-xl mb-8" id="hero-subtitle">
                        {{ $slides[0]['subtitle'] }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('who-we-are') }}" class="btn-primary text-base" style="background: linear-gradient(135deg, var(--color-red), var(--color-red-light)); color: white;">
                            Discover Our Story
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ route('donate') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-white/30 text-white font-semibold hover:bg-white hover:text-navy transition-all duration-300">
                            Support Our Mission
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-0 right-0 z-10 flex justify-center gap-3">
            @foreach($slides as $i => $slide)
                <button class="slider-dot {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}" aria-label="Slide {{ $i + 1 }}"></button>
            @endforeach
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-wwhite to-transparent z-10"></div>
    </section>

    {{-- Stats Bar --}}
    <section class="relative -mt-16 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card rounded-2xl p-8 shadow-xl">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $stats = [
                        ['value' => '1990', 'label' => 'Founded', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['value' => '70+', 'label' => 'Member Churches', 'icon' => 'M19 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m8-10a4 4 0 10-8 0 4 4 0 008 0z'],
                        ['value' => '3', 'label' => 'Regions Served', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['value' => '34+', 'label' => 'Years of Ministry', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ];
                @endphp
                @foreach($stats as $stat)
                    <div class="text-center animate-on-scroll fade-in-up">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gradient-to-br from-red/10 to-red/5 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/></svg>
                        </div>
                        <p class="font-heading text-3xl font-bold text-navy mb-1 count-up" data-target="{{ $stat['value'] }}">0</p>
                        <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Vision & Mission --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="animate-on-scroll fade-in-left bg-white rounded-2xl p-8 md:p-10 shadow-sm border border-gray-100 card-hover">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red/20 to-red/5 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h2 class="font-heading text-2xl font-bold text-navy mb-4">Our Vision</h2>
                    <p class="text-gray-600 leading-relaxed text-lg italic">
                        "A Christian Community Promoting Renewed, Healed and Prayerful Christians"
                    </p>
                </div>
                <div class="animate-on-scroll fade-in-right bg-white rounded-2xl p-8 md:p-10 shadow-sm border border-gray-100 card-hover">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red/20 to-red/5 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h2 class="font-heading text-2xl font-bold text-navy mb-4">Our Mission</h2>
                    <p class="text-gray-600 leading-relaxed text-lg italic">
                        "To Discover United; Christian Centred Answers to the Current Challenges of Life"
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Video Section --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-on-scroll fade-in-up">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Watch</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3">Our <span class="text-red">Journey</span></h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">See the heart of WCCF — worship, fellowship, and community outreach in action.</p>
            </div>
            <div class="animate-on-scroll fade-in-up max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-xl aspect-video">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="WCCF Journey" class="w-full h-full" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    {{-- About Preview --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute left-0 top-0 w-64 h-64 bg-red/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="animate-on-scroll fade-in-left">
                    <span class="text-red font-semibold text-sm tracking-widest uppercase">Who We Are</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3 mb-6">
                        A Fellowship Rooted in <span class="text-red">Faith & Community</span>
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        WCCF transformed from the former Lugbara Christian Community Fellowship (LCCF) founded in 1990. Guided by Hebrews 10:25, we unite the West Nile community in diaspora to fellowship in their own languages.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        Today we bring together over 70 member churches spread across Buganda, Busoga and Bunyoro regions.
                    </p>
                    <a href="{{ route('who-we-are') }}" class="btn-primary">
                        Read Our Full Story
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="animate-on-scroll fade-in-right relative">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=800&q=80" alt="Community worship" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-navy rounded-2xl p-6 shadow-xl">
                        <p class="font-heading text-2xl font-bold text-red">Hebrews 10:25</p>
                        <p class="text-gray-400 text-sm mt-1 max-w-[200px]">"Not giving up meeting together..."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Photo Gallery --}}
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-on-scroll fade-in-up">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Gallery</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3">Moments of <span class="text-red">Fellowship</span></h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Glimpses of worship, community gatherings, and outreach across the West Nile region.</p>
            </div>

            <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
                @php
                    $gallery = [
                        ['img' => 'https://images.unsplash.com/photo-1548625149-fc4a29cf7092?w=600&q=80', 'caption' => 'Community Worship Gathering'],
                        ['img' => 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=600&q=80', 'caption' => 'Fellowship Conference'],
                        ['img' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=600&q=80', 'caption' => 'Outreach Program'],
                        ['img' => 'https://images.unsplash.com/photo-1593113630400-ea4288922497?w=600&q=80', 'caption' => 'Community Impact'],
                        ['img' => 'https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?w=600&q=80', 'caption' => 'Youth Fellowship'],
                        ['img' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=600&q=80', 'caption' => 'Team Building'],
                        ['img' => 'https://images.unsplash.com/photo-1476237775687-c9598f74d88d?w=600&q=80', 'caption' => 'Sunday Service'],
                        ['img' => 'https://images.unsplash.com/photo-1560520653-9e0e4c89eb11?w=600&q=80', 'caption' => 'Community Outreach'],
                        ['img' => 'https://images.unsplash.com/photo-1529543544282-ea07407f1d64?w=600&q=80', 'caption' => 'Prayer Gathering'],
                        ['img' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=600&q=80', 'caption' => 'Children\'s Ministry'],
                        ['img' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=600&q=80', 'caption' => 'Conference Event'],
                        ['img' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600&q=80', 'caption' => 'Food Drive'],
                    ];
                @endphp
                @foreach($gallery as $photo)
                    <div class="animate-on-scroll fade-in-up break-inside-avoid overflow-hidden rounded-xl shadow-md group relative">
                        <img src="{{ $photo['img'] }}" alt="{{ $photo['caption'] }}" class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <p class="text-white text-sm font-medium">{{ $photo['caption'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Core Values --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-navy to-navy-light"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Our Foundation</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white mt-3">Core Values</h2>
                <p class="text-gray-400 mt-4 max-w-2xl mx-auto">The principles that guide every aspect of our fellowship and ministry.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $values = [
                        ['title' => 'Living Biblically', 'desc' => 'Scripture-centered life and doctrine guiding all we do.', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                        ['title' => 'Building Lovely Families', 'desc' => 'Strengthening families as the foundation of Christian community.', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                        ['title' => 'Serving the Needy', 'desc' => 'Extending Christ\'s love through compassionate service.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['title' => 'Uplifting Worship', 'desc' => 'Developing and enriching liturgical worship experiences.', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ];
                @endphp
                @foreach($values as $value)
                    <div class="animate-on-scroll fade-in-up group bg-white/5 border border-white/10 rounded-2xl p-6 card-hover backdrop-blur-sm">
                        <div class="w-12 h-12 rounded-xl bg-red/10 flex items-center justify-center mb-5 group-hover:bg-red/20 transition-colors">
                            <svg class="w-6 h-6 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $value['icon'] }}"/></svg>
                        </div>
                        <h3 class="font-heading text-lg font-semibold text-white mb-2">{{ $value['title'] }}</h3>
                        <p class="text-gray-400 text-sm leading-relaxed">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-red/5 via-transparent to-red/5"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mb-6">
                    Join Us in <span class="text-red">Faith & Fellowship</span>
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
                    Whether you're looking for a spiritual home, want to serve, or need support — WCCF welcomes you. Together, we build a community rooted in Christ.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('get-involved') }}" class="btn-primary">
                        Get Involved
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('donate') }}" class="btn-outline border-navy text-navy hover:bg-navy hover:text-white">
                        Make a Donation
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
