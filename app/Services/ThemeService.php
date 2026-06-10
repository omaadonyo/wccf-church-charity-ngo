<?php

namespace App\Services;

use App\Models\ThemeSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ThemeService
{
    protected string $themesPath;

    public function __construct()
    {
        $this->themesPath = resource_path('themes');
    }

    public function getActiveThemeSlug(): string
    {
        return ThemeSetting::getValue('active_theme', 'default');
    }

    public function getAll(): array
    {
        $themes = [];
        $directories = File::directories($this->themesPath);

        foreach ($directories as $dir) {
            $manifest = $this->readManifest($dir);
            if ($manifest) {
                $themes[] = $manifest;
            }
        }

        usort($themes, fn ($a, $b) => $a['slug'] === 'default' ? -1 : ($b['slug'] === 'default' ? 1 : strcmp($a['name'], $b['name'])));

        return $themes;
    }

    public function getActive(): ?array
    {
        $slug = $this->getActiveThemeSlug();
        $path = $this->themesPath . '/' . $slug;
        if (!File::isDirectory($path)) {
            return $this->readManifest($this->themesPath . '/default');
        }
        return $this->readManifest($path);
    }

    public function getViewPath(string $slug = null): string
    {
        $slug = $slug ?? $this->getActiveThemeSlug();
        return $this->themesPath . '/' . $slug . '/views';
    }

    public function getAssetPath(string $slug = null): string
    {
        $slug = $slug ?? $this->getActiveThemeSlug();
        return $this->themesPath . '/' . $slug . '/public';
    }

    public function assetUrl(string $path): string
    {
        $slug = $this->getActiveThemeSlug();
        $filePath = $this->getAssetPath($slug) . '/' . ltrim($path, '/');
        if (file_exists($filePath)) {
            return route('theme.asset', ['slug' => $slug, 'path' => $path]);
        }
        return '';
    }

    public function serveAsset(string $slug, string $path): \Illuminate\Http\Response
    {
        $filePath = $this->getAssetPath($slug) . '/' . ltrim($path, '/');
        if (!file_exists($filePath)) {
            abort(404);
        }
        $mime = mime_content_type($filePath) ?: 'application/octet-stream';
        return response(file_get_contents($filePath), 200, ['Content-Type' => $mime]);
    }

    public function activate(string $slug): bool
    {
        $path = $this->themesPath . '/' . $slug;
        if (!File::isDirectory($path)) {
            return false;
        }
        $manifest = $this->readManifest($path);
        if (!$manifest) {
            return false;
        }
        ThemeSetting::setValue('active_theme', $slug);
        return true;
    }

    public function uninstall(string $slug): bool
    {
        if ($slug === 'default') {
            return false;
        }

        $path = $this->themesPath . '/' . $slug;
        if (!File::isDirectory($path)) {
            return false;
        }

        if ($this->getActiveThemeSlug() === $slug) {
            ThemeSetting::setValue('active_theme', 'default');
        }

        File::deleteDirectory($path);
        return true;
    }

    public function installFromZip(\Illuminate\Http\UploadedFile $file): array
    {
        $zip = new \ZipArchive();
        $res = $zip->open($file->path());

        if ($res !== true) {
            return ['success' => false, 'error' => 'Could not open zip file.'];
        }

        $tempDir = storage_path('app/temp_theme_' . uniqid());
        File::makeDirectory($tempDir, 0755, true);

        $zip->extractTo($tempDir);
        $zip->close();

        $items = File::directories($tempDir);
        $themeDir = null;

        foreach ($items as $item) {
            if (File::exists($item . '/theme.json')) {
                $themeDir = $item;
                break;
            }
        }

        if (!$themeDir) {
            if (File::exists($tempDir . '/theme.json')) {
                $themeDir = $tempDir;
            }
        }

        if (!$themeDir) {
            File::deleteDirectory($tempDir);
            return ['success' => false, 'error' => 'No theme.json found in the zip archive.'];
        }

        $manifest = $this->readManifest($themeDir);
        if (!$manifest) {
            File::deleteDirectory($tempDir);
            return ['success' => false, 'error' => 'Invalid theme.json.'];
        }

        $slug = $manifest['slug'];
        $destPath = $this->themesPath . '/' . $slug;

        if (File::isDirectory($destPath)) {
            File::deleteDirectory($tempDir);
            return ['success' => false, 'error' => 'Theme "' . $slug . '" already exists.'];
        }

        File::copyDirectory($themeDir, $destPath);
        File::deleteDirectory($tempDir);

        return ['success' => true, 'theme' => $manifest];
    }

    public function hasView(string $view, string $slug = null): bool
    {
        $slug = $slug ?? $this->getActiveThemeSlug();
        $path = $this->getViewPath($slug) . '/' . str_replace('.', '/', $view) . '.blade.php';
        return File::exists($path);
    }

    protected function readManifest(string $dir): ?array
    {
        $manifestPath = $dir . '/theme.json';
        if (!File::exists($manifestPath)) {
            return null;
        }

        $manifest = json_decode(File::get($manifestPath), true);
        if (!$manifest || !isset($manifest['slug'])) {
            return null;
        }

        $manifest['path'] = $dir;
        $manifest['screenshot_url'] = $this->getScreenshotUrl($dir, $manifest['slug']);
        $manifest['is_active'] = $manifest['slug'] === $this->getActiveThemeSlug();
        $manifest['is_default'] = $manifest['slug'] === 'default';

        return $manifest;
    }

    protected function getScreenshotUrl(string $dir, string $slug): ?string
    {
        $screenshot = null;
        foreach (['screenshot.png', 'screenshot.jpg', 'screenshot.jpeg', 'preview.png'] as $name) {
            if (File::exists($dir . '/' . $name)) {
                $relativePath = 'themes/' . $slug . '/' . $name;
                $publicPath = public_path($relativePath);
                if (File::exists($publicPath)) {
                    $screenshot = asset($relativePath);
                }
                break;
            }
        }
        return $screenshot;
    }
}
