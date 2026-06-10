<?php

namespace App\Providers;

use App\Services\ThemeService;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\FileViewFinder;

class ThemeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ThemeService::class, fn () => new ThemeService());
        $this->app->alias(ThemeService::class, 'theme');
    }

    public function boot(): void
    {
        $themeService = $this->app->make(ThemeService::class);

        $view = $this->app->make('view');
        $finder = $view->getFinder();

        if ($finder instanceof FileViewFinder) {
            $themeViewsPath = $themeService->getViewPath();
            if (is_dir($themeViewsPath)) {
                $finder->prependLocation($themeViewsPath);
            }
        }
    }
}
