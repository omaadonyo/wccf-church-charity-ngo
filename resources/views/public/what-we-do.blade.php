@extends('layouts.public')

@section('title', 'What We Do')

@section('content')
    {{-- Hero --}}
    <section class="relative min-h-[50vh] flex items-center overflow-hidden bg-navy">
        <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy-light to-navy"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 70% 30%, color-mix(in srgb, var(--color-primary) 8%, transparent) 0%, transparent 50%), radial-gradient(circle at 30% 70%, color-mix(in srgb, var(--color-primary) 6%, transparent) 0%, transparent 50%);"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16 w-full">
            <div class="animate-on-scroll fade-in-up text-center">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Our Work</span>
                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-4 mb-6">What We Do</h1>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                    Through worship, fellowship, community service, and spiritual development, WCCF serves the West Nile Christian community across Uganda.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-wwhite to-transparent"></div>
    </section>

    {{-- Areas of Focus --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Our Focus</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3">Areas of <span class="text-red">Ministry</span></h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Through these core areas, we fulfill our mission of uniting and serving the West Nile Christian community.</p>
            </div>

            <div class="space-y-24">
                {{-- Evangelism & Worship --}}
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="animate-on-scroll fade-in-left order-2 lg:order-1">
                        <span class="font-heading text-5xl font-bold text-red/10">01</span>
                        <h3 class="font-heading text-2xl sm:text-3xl font-bold text-navy mt-2 mb-4">Evangelism & Worship</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            We organize the West Nile Christian community to fellowship with God through vibrant evangelism, heartfelt praise, and meaningful worship. Our gatherings celebrate the richness of our diverse cultural heritage while remaining rooted in biblical truth.
                        </p>
                        <ul class="space-y-3">
                            @php
                                $items = ['Monthly fellowship gatherings', 'Community outreach programs', 'Inter-church worship events', 'Youth and children\'s ministries'];
                            @endphp
                            @foreach($items as $item)
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-gray-600">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="animate-on-scroll fade-in-right order-1 lg:order-2">
                        <div class="rounded-2xl overflow-hidden shadow-xl aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1507692049790-de58290a4334?w=800&q=80" alt="Worship" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                {{-- Annual Fellowship --}}
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="animate-on-scroll fade-in-left order-2">
                        <span class="font-heading text-5xl font-bold text-red/10">02</span>
                        <h3 class="font-heading text-2xl sm:text-3xl font-bold text-navy mt-2 mb-4">Annual Christian Fellowship</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Each year, we organize Christian Fellowship events across member churches through our established Departments. These gatherings strengthen bonds, encourage spiritual growth, and celebrate our shared faith.
                        </p>
                        <ul class="space-y-3">
                            @php
                                $items = ['Annual conferences and conventions', 'Departmental fellowship events', 'Regional gatherings', 'Special themed retreats'];
                            @endphp
                            @foreach($items as $item)
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-gray-600">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="animate-on-scroll fade-in-right order-1">
                        <div class="rounded-2xl overflow-hidden shadow-xl aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1529543544282-ea4e0ee3f30d?w=800&q=80" alt="Fellowship gathering" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                {{-- Seminars & Conferences --}}
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="animate-on-scroll fade-in-left order-2 lg:order-1">
                        <span class="font-heading text-5xl font-bold text-red/10">03</span>
                        <h3 class="font-heading text-2xl sm:text-3xl font-bold text-navy mt-2 mb-4">Seminars & Spiritual Development</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            We organize seminars, workshops, and conferences addressing both spiritual and social needs. These events equip our members with biblical knowledge, life skills, and practical tools for daily Christian living.
                        </p>
                        <ul class="space-y-3">
                            @php
                                $items = ['Leadership development workshops', 'Biblical teaching and doctrine seminars', 'Marriage and family conferences', 'Youth empowerment programs'];
                            @endphp
                            @foreach($items as $item)
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-gray-600">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="animate-on-scroll fade-in-right order-1 lg:order-2">
                        <div class="rounded-2xl overflow-hidden shadow-xl aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80" alt="Conference" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                {{-- Charitable Assistance --}}
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="animate-on-scroll fade-in-left order-2">
                        <span class="font-heading text-5xl font-bold text-red/10">04</span>
                        <h3 class="font-heading text-2xl sm:text-3xl font-bold text-navy mt-2 mb-4">Charitable & Community Support</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            We extend Christ's love through practical assistance to the needy in our community. Partnering with government institutions and development agencies, we provide support that transforms lives and communities.
                        </p>
                        <ul class="space-y-3">
                            @php
                                $items = ['Food and relief assistance', 'Medical outreach programs', 'Educational support for children', 'Support for the elderly and vulnerable'];
                            @endphp
                            @foreach($items as $item)
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-red mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-gray-600">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="animate-on-scroll fade-in-right order-1">
                        <div class="rounded-2xl overflow-hidden shadow-xl aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800&q=80" alt="Community service" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Impact Stats --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-red/3 via-transparent to-red/3"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy">Our <span class="text-red">Impact</span></h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Through decades of faithful service, WCCF has grown and touched countless lives.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $impacts = [
                        ['value' => '70+', 'label' => 'Member Churches', 'color' => 'from-red/20 to-red/5', 'text' => 'text-red'],
                        ['value' => '3', 'label' => 'Regions Covered', 'color' => 'from-red/20 to-red/5', 'text' => 'text-red'],
                        ['value' => '34+', 'label' => 'Years of Service', 'color' => 'from-red/20 to-red/5', 'text' => 'text-red'],
                        ['value' => '1000s', 'label' => 'Lives Impacted', 'color' => 'from-red/20 to-red/5', 'text' => 'text-red'],
                    ];
                @endphp
                @foreach($impacts as $impact)
                    <div class="animate-on-scroll fade-in-up text-center">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br {{ $impact['color'] }} flex items-center justify-center">
                            <span class="font-heading text-2xl font-bold {{ $impact['text'] }}">{{ $impact['value'] }}</span>
                        </div>
                        <p class="text-gray-600 font-medium">{{ $impact['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-navy"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white mb-6">
                    Partner With <span class="text-red">Us</span>
                </h2>
                <p class="text-gray-300 text-lg mb-8 max-w-2xl mx-auto">
                    Your support enables us to continue serving the West Nile Christian community and extending help to those in need.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('donate') }}" class="btn-primary">
                        Support Our Work
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('get-involved') }}" class="btn-outline border-white/30 text-white hover:bg-white hover:text-navy">
                        Volunteer With Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
