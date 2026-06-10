<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth"
    @php
        $tpPrimary = \App\Models\ThemeSetting::getValue('theme_primary_color', '#560534');
        $tpPrimaryLight = \App\Models\ThemeSetting::getValue('theme_primary_light', '#8c2355');
        $tpPrimaryDark = \App\Models\ThemeSetting::getValue('theme_primary_dark', '#3c0324');
        $tpSecondary = \App\Models\ThemeSetting::getValue('theme_secondary_color', '#0f1b2d');
        $tpSecondaryLight = \App\Models\ThemeSetting::getValue('theme_secondary_light', '#1a2d4a');
        $tpSurface = \App\Models\ThemeSetting::getValue('theme_surface_color', '#fbf9f6');
        $tpSurfaceDark = \App\Models\ThemeSetting::getValue('theme_surface_dark', '#f5f0ea');
        $tpText = \App\Models\ThemeSetting::getValue('theme_text_color', '#2d2d2d');
    @endphp
    style="--tp-primary:{{ $tpPrimary }};--tp-primary-light:{{ $tpPrimaryLight }};--tp-primary-dark:{{ $tpPrimaryDark }};--tp-secondary:{{ $tpSecondary }};--tp-secondary-light:{{ $tpSecondaryLight }};--tp-surface:{{ $tpSurface }};--tp-surface-dark:{{ $tpSurfaceDark }};--tp-text:{{ $tpText }}"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="West Nile Christian Community Fellowship - A Christian Community Promoting Renewed, Healed and Prayerful Christians">
    <meta name="theme-color" content="{{ \App\Models\ThemeSetting::getValue('theme_secondary_color', '#0f1b2d') }}">
    <title>@yield('title', 'WCCF') | West Nile Christian Community Fellowship</title>

    @php
        $favicon = \App\Models\ThemeSetting::getValue('theme_favicon_url');
    @endphp
    @if($favicon)
        <link rel="icon" href="{{ $favicon }}" sizes="any">
        <link rel="icon" href="{{ $favicon }}" type="image/svg+xml">
        <link rel="apple-touch-icon" href="{{ $favicon }}">
    @else
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @php $themeCss = theme()->assetUrl('css/theme.css'); @endphp
    @if($themeCss)
        <link rel="stylesheet" href="{{ $themeCss }}">
    @endif
    @stack('styles')
</head>
<body class="antialiased">
    <nav class="navbar fixed top-0 left-0 right-0 z-50 transition-all duration-300 @yield('navbarExtra', 'navbar-solid')" data-transparent="@yield('navbarTransparent', 'false')">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                @php $logo = \App\Models\ThemeSetting::getValue('theme_logo_url'); @endphp
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @if($logo)
                        <img src="{{ $logo }}" alt="WCCF" class="h-10 w-auto object-contain">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red to-red-light flex items-center justify-center text-white font-heading font-bold text-lg transition-transform duration-300 group-hover:scale-105">
                            W
                        </div>
                        <div class="hidden sm:block">
                            <span class="font-heading text-xl font-bold text-white">WCCF</span>
                            <span class="block text-xs text-white/60 -mt-1">West Nile Christian Fellowship</span>
                        </div>
                    @endif
                </a>

                <div class="hidden lg:flex items-center gap-8">
                    @php
                        $links = [
                            ['route' => 'home', 'label' => 'Home'],
                            ['route' => 'who-we-are', 'label' => 'Who We Are'],
                            ['route' => 'what-we-do', 'label' => 'What We Do'],
                            ['route' => 'news.index', 'label' => 'News'],
                            ['route' => 'get-involved', 'label' => 'Get Involved'],
                            ['route' => 'donate', 'label' => 'Donate'],
                        ];
                    @endphp
                    @foreach($links as $link)
                        <a href="{{ route($link['route']) }}"
                           class="nav-link text-sm tracking-wide @if(Route::currentRouteName() === $link['route']) active @endif text-white/80 hover:text-white">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    <a href="{{ route('donate') }}" class="btn-primary text-sm px-5 py-2.5 bg-white text-navy hover:bg-white/90 shadow-lg" style="background: white; color: #0f1b2d;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Give Now
                    </a>
                </div>

                <button class="mobile-menu-toggle lg:hidden w-10 h-10 flex items-center justify-center rounded-lg transition-colors hover:bg-white/10 text-white" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <div class="mobile-overlay fixed inset-0 z-40 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"></div>

    <div class="mobile-menu fixed top-0 right-0 z-50 h-full w-80 max-w-[85vw] bg-wwhite shadow-2xl translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <span class="font-heading text-xl font-bold text-navy">Menu</span>
            <button class="mobile-menu-toggle w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-colors" aria-label="Close menu">
                <svg class="w-5 h-5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 flex flex-col gap-4">
            @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="text-lg font-medium @if(Route::currentRouteName() === $link['route']) text-red @else text-gray-700 hover:text-navy @endif transition-colors py-2">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="mt-4 pt-4 border-t border-gray-100">
                <a href="{{ route('donate') }}" class="btn-primary w-full justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Give Now
                </a>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="bg-navy text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div class="animate-on-scroll fade-in-up">
                    <div class="flex items-center gap-3 mb-4">
                        @if($logo)
                            <img src="{{ $logo }}" alt="WCCF" class="h-10 w-auto object-contain brightness-0 invert">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red to-red-light flex items-center justify-center text-white font-heading font-bold text-lg">
                                W
                            </div>
                        @endif
                        <div>
                            <span class="font-heading text-xl font-bold text-white">WCCF</span>
                            <span class="block text-xs text-gray-400 -mt-1">West Nile Christian Fellowship</span>
                        </div>
                    </div>
                    @php
                        $footerDesc = \App\Models\ThemeSetting::getValue('footer_description', 'A Christian Community Promoting Renewed, Healed and Prayerful Christians.');
                        $footerAddress = \App\Models\ThemeSetting::getValue('footer_address', 'Kampala, Uganda');
                        $footerEmail = \App\Models\ThemeSetting::getValue('footer_email', 'info@wccfuganda.org');
                        $footerPhone = \App\Models\ThemeSetting::getValue('footer_phone', '+256 (0) 700 000 000');
                        $footerFacebook = \App\Models\ThemeSetting::getValue('footer_facebook_url', '#');
                        $footerTwitter = \App\Models\ThemeSetting::getValue('footer_twitter_url', '#');
                        $footerInstagram = \App\Models\ThemeSetting::getValue('footer_instagram_url', '#');
                        $footerYoutube = \App\Models\ThemeSetting::getValue('footer_youtube_url', '#');
                        $footerCopyright = \App\Models\ThemeSetting::getValue('footer_copyright_text', 'West Nile Christian Community Fellowship Ltd. All rights reserved.');
                        $footerRegistration = \App\Models\ThemeSetting::getValue('footer_registration_text', 'Registered with Uganda Registration Services Bureau (URSB) No. 80020002936115');
                    @endphp
                    <p class="text-gray-400 text-sm leading-relaxed">
                        {{ $footerDesc }}
                    </p>
                </div>

                <div class="animate-on-scroll fade-in-up">
                    <h3 class="font-heading text-lg font-semibold text-red mb-4">Quick Links</h3>
                    <ul class="space-y-3">
                        @foreach($links as $link)
                            <li>
                                <a href="{{ route($link['route']) }}" class="text-gray-400 hover:text-red text-sm transition-colors">
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="animate-on-scroll fade-in-up">
                    <h3 class="font-heading text-lg font-semibold text-red mb-4">Contact</h3>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $footerAddress }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ $footerEmail }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-red flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ $footerPhone }}</span>
                        </li>
                    </ul>
                </div>

                <div class="animate-on-scroll fade-in-up">
                    <h3 class="font-heading text-lg font-semibold text-red mb-4">Follow Us</h3>
                    <div class="flex gap-3">
                        <a href="{{ $footerFacebook }}" class="w-10 h-10 rounded-full bg-white/10 hover:bg-red hover:text-white flex items-center justify-center transition-all duration-300" aria-label="Facebook" target="_blank" rel="noopener">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="{{ $footerTwitter }}" class="w-10 h-10 rounded-full bg-white/10 hover:bg-red hover:text-white flex items-center justify-center transition-all duration-300" aria-label="Twitter" target="_blank" rel="noopener">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="{{ $footerInstagram }}" class="w-10 h-10 rounded-full bg-white/10 hover:bg-red hover:text-white flex items-center justify-center transition-all duration-300" aria-label="Instagram" target="_blank" rel="noopener">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3H7.5A4.5 4.5 0 003 7.5v9A4.5 4.5 0 007.5 21h9a4.5 4.5 0 004.5-4.5v-9A4.5 4.5 0 0016.5 3z"/><circle cx="12" cy="12" r="3"/><path d="M17.5 6.5h.01"/></svg>
                        </a>
                        <a href="{{ $footerYoutube }}" class="w-10 h-10 rounded-full bg-white/10 hover:bg-red hover:text-white flex items-center justify-center transition-all duration-300" aria-label="YouTube" target="_blank" rel="noopener">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-xs">
                    &copy; {{ date('Y') }} {{ $footerCopyright }}
                </p>
                <p class="text-gray-500 text-xs">
                    {{ $footerRegistration }}
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
