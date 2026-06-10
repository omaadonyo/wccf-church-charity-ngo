@extends('layouts.public')

@section('title', 'Who We Are')

@section('content')
    {{-- Hero --}}
    <section class="relative min-h-[50vh] flex items-center overflow-hidden bg-navy">
        <div class="absolute inset-0 bg-gradient-to-br from-navy via-navy-light to-navy"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 30% 50%, color-mix(in srgb, var(--color-primary) 6%, transparent) 0%, transparent 50%), radial-gradient(circle at 70% 30%, color-mix(in srgb, var(--color-primary) 6%, transparent) 0%, transparent 50%);"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-16 w-full">
            <div class="animate-on-scroll fade-in-up text-center">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">About Us</span>
                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white mt-4 mb-6">Who We Are</h1>
                <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                    A faith-based, not-for-profit umbrella organization uniting the West Nile community in diaspora through fellowship, worship, and service.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-wwhite to-transparent"></div>
    </section>

    {{-- Story --}}
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-start">
                <div class="animate-on-scroll fade-in-left">
                    <span class="text-red font-semibold text-sm tracking-widest uppercase">Our Story</span>
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3 mb-6">
                        From <span class="text-red">Humble Beginnings</span>
                    </h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-600 leading-relaxed mb-4">
                            West Nile Christian Community Fellowship (WCCF) Limited is a faith-based, not-for-profit umbrella organization registered and limited by Guarantee. The organization was incorporated by Uganda Registration Services Bureau (URSB) as a Company Limited by guarantee under Registration No. 80020002936115 on the 25th day of February 2021. The Fellowship is legally operating as a faith-based organization in Uganda and is guided by its Constitution promulgated in July 2011 and as amended in 2019.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            WCCF transformed from the former Lugbara Christian Community Fellowship (LCCF) founded in 1990 under the background idea that, since the Lugbara Community were now mixed with different tribes and languages, they could be drawn to worshiping other gods of the land, hence deviating from the true God they know back home.
                        </p>
                    </div>
                </div>
                <div class="animate-on-scroll fade-in-right space-y-6">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1438232997411-2f5e1e7d0d3a?w=800&q=80" alt="Church gathering" class="w-full aspect-[4/3] object-cover">
                    </div>
                    <div class="glass-card rounded-xl p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-red/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <div>
                                <p class="font-heading font-semibold text-navy">Hebrews 10:25 (NIV)</p>
                                <p class="text-gray-500 text-sm mt-1 italic">"Not giving up meeting together, as some are in the habit of doing, but encouraging one another—and all the more as you see the Day approaching."</p>
                                <p class="text-gray-400 text-xs mt-2">This verse became the anchor and driving motto of the organization.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Growth --}}
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-red/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="animate-on-scroll fade-in-left">
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mb-6">
                        Growth & <span class="text-red">Expansion</span>
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        The fellowship started with initially three member churches: St. Francis Chapel Makerere, St. Paul Church Okuvu, and St. John's Church Entebbe. Later, Gabba Church of Uganda joined.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        The core objective of the Fellowship is to unite all the West Nile community in diaspora to fellowship in their own languages, since language barrier was a big challenge to many ethnic West Nile people other than those who can speak English.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        The Fellowship now operates under a constitution written in July 2011 and amended in 2019, bringing together over 70 member churches spread across Buganda, Busoga and Bunyoro regions, with St. Phillips Church of Uganda Kyebando as the only prominent Alur Community.
                    </p>
                </div>
                <div class="animate-on-scroll fade-in-right grid grid-cols-2 gap-4">
                    <div class="bg-wwhite rounded-2xl p-6 card-hover">
                        <p class="font-heading text-3xl font-bold text-navy">1990</p>
                        <p class="text-sm text-gray-500 mt-1">Founded as LCCF</p>
                    </div>
                    <div class="bg-wwhite rounded-2xl p-6 card-hover">
                        <p class="font-heading text-3xl font-bold text-navy">3</p>
                        <p class="text-sm text-gray-500 mt-1">Founding Churches</p>
                    </div>
                    <div class="bg-wwhite rounded-2xl p-6 card-hover">
                        <p class="font-heading text-3xl font-bold text-navy">70+</p>
                        <p class="text-sm text-gray-500 mt-1">Member Churches</p>
                    </div>
                    <div class="bg-wwhite rounded-2xl p-6 card-hover">
                        <p class="font-heading text-3xl font-bold text-navy">2021</p>
                        <p class="text-sm text-gray-500 mt-1">URSB Registration</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Vision Mission Values --}}
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-navy to-navy-light"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white">Our Foundation</h2>
                <p class="text-gray-400 mt-4 max-w-2xl mx-auto">The vision, mission, and values that define and guide WCCF.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <div class="animate-on-scroll fade-in-left bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red/20 to-red/5 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold text-white mb-3">Our Vision</h3>
                    <p class="text-gray-300 leading-relaxed italic">
                        "A Christian Community Promoting Renewed, Healed and Prayerful Christians"
                    </p>
                </div>
                <div class="animate-on-scroll fade-in-right bg-white/5 border border-white/10 rounded-2xl p-8 backdrop-blur-sm">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red/20 to-red/5 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="font-heading text-xl font-semibold text-white mb-3">Our Mission</h3>
                    <p class="text-gray-300 leading-relaxed italic">
                        "To Discover United; Christian Centred Answers to the Current Challenges of Life"
                    </p>
                </div>
            </div>

            <div class="animate-on-scroll fade-in-up">
                <h3 class="font-heading text-2xl font-bold text-red text-center mb-10">Our Core Values</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $values = [
                            ['title' => 'Living Biblically', 'desc' => 'Scripture-centered life and doctrine guiding all we do.'],
                            ['title' => 'Building Lovely Families', 'desc' => 'Strengthening families as the foundation of Christian community.'],
                            ['title' => 'Serving Hurting People & the Needy', 'desc' => 'Extending Christ\'s love through compassionate service to the vulnerable.'],
                            ['title' => 'Uplifting Liturgical Worship', 'desc' => 'Developing and enriching worship experiences that draw people closer to God.'],
                        ];
                    @endphp
                    @foreach($values as $value)
                        <div class="bg-white/5 border border-white/10 rounded-xl p-6 card-hover">
                            <div class="w-10 h-10 rounded-lg bg-red/10 flex items-center justify-center mb-4">
                                <svg class="w-5 h-5 text-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <h4 class="font-heading font-semibold text-white mb-2">{{ $value['title'] }}</h4>
                            <p class="text-gray-400 text-sm">{{ $value['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Objectives --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-on-scroll fade-in-up">
                <span class="text-red font-semibold text-sm tracking-widest uppercase">Our Purpose</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy mt-3">Core Objectives</h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">The key objectives that guide the fellowship's operations and activities.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $objectives = [
                        ['num' => '01', 'title' => 'Organize Fellowship', 'desc' => 'To organize the Westnile Christian Community to fellowship with God through evangelism, praise and worship.'],
                        ['num' => '02', 'title' => 'Annual Gatherings', 'desc' => 'To organize annual Christian Fellowship in the member Churches through its established Departments.'],
                        ['num' => '03', 'title' => 'Spiritual Development', 'desc' => 'To organize seminars, workshops, conferences and other Christian related social and spiritual activities among its member churches.'],
                        ['num' => '04', 'title' => 'Support Member Churches', 'desc' => 'To support the established Departments and member churches in their social and faith based developmental efforts.'],
                        ['num' => '05', 'title' => 'Charitable Assistance', 'desc' => 'To render charitable assistance to the needy in the community in partnership with government institutions and other organizations.'],
                        ['num' => '06', 'title' => 'Database & Information', 'desc' => 'To establish system database for keeping all relevant information of the Fellowship.'],
                        ['num' => '07', 'title' => 'Fulfillment of Objectives', 'desc' => 'To do any such activities as shall be deemed necessary from time to time by the Executive for the fulfilment of the objectives of the Fellowship.'],
                    ];
                @endphp
                @foreach($objectives as $obj)
                    <div class="animate-on-scroll fade-in-up group bg-wwhite rounded-xl p-6 border border-gray-100 card-hover">
                        <span class="font-heading text-3xl font-bold text-red/30 group-hover:text-red/60 transition-colors">{{ $obj['num'] }}</span>
                        <h3 class="font-heading text-lg font-semibold text-navy mt-2 mb-2">{{ $obj['title'] }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $obj['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 relative overflow-hidden bg-navy">
        <div class="absolute inset-0 bg-gradient-to-r from-navy via-navy-light to-navy"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-on-scroll fade-in-up">
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white mb-6">
                    Want to Know <span class="text-red">More?</span>
                </h2>
                <p class="text-gray-300 text-lg mb-8">Explore how WCCF serves the community and how you can be part of this mission.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('what-we-do') }}" class="btn-primary">
                        What We Do
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('get-involved') }}" class="btn-outline border-white/30 text-white hover:bg-white hover:text-navy">
                        Get Involved
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
