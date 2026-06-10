<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
</title>

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
<style>:root{--tp-primary:{{ $tpPrimary }};--tp-primary-light:{{ $tpPrimaryLight }};--tp-primary-dark:{{ $tpPrimaryDark }};--tp-secondary:{{ $tpSecondary }};--tp-secondary-light:{{ $tpSecondaryLight }};--tp-surface:{{ $tpSurface }};--tp-surface-dark:{{ $tpSurfaceDark }};--tp-text:{{ $tpText }}}</style>

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

@fonts

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
@stack('head')
