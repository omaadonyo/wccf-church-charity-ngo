<?php

use App\Services\ThemeService;

if (!function_exists('theme')) {
    function theme(): ThemeService
    {
        return app(ThemeService::class);
    }
}

if (!function_exists('theme_asset')) {
    function theme_asset(string $path): string
    {
        return app(ThemeService::class)->assetUrl($path);
    }
}
