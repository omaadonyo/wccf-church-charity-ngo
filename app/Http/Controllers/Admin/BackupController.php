<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Media;
use App\Models\Page;
use App\Models\ThemeSetting;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController
{
    public function index()
    {
        return view('admin.backup.index');
    }

    public function export()
    {
        $data = [
            'exported_at' => now()->toIso8601String(),
            'version' => '1.0',
            'pages' => Page::all()->toArray(),
            'blog_posts' => BlogPost::with('category', 'featuredImage')->get()->toArray(),
            'blog_categories' => BlogCategory::all()->toArray(),
            'media' => Media::all()->toArray(),
            'theme_settings' => ThemeSetting::all()->toArray(),
        ];

        $filename = 'backup-' . now()->format('Y-m-d-His') . '.json';
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        return response()->streamDownload(function () use ($json) {
            echo $json;
        }, $filename, ['Content-Type' => 'application/json']);
    }

    public function import(Request $request)
    {
        $request->validate(['backup_file' => 'required|file|mimes:json|max:102400']);

        $json = file_get_contents($request->file('backup_file')->path());
        $data = json_decode($json, true);

        if (!$data || !isset($data['version'])) {
            return back()->with('error', 'Invalid backup file.');
        }

        $imported = ['pages' => 0, 'blog_posts' => 0, 'blog_categories' => 0, 'media' => 0, 'theme_settings' => 0];

        if (isset($data['pages'])) {
            foreach ($data['pages'] as $pageData) {
                Page::updateOrCreate(['id' => $pageData['id']], $pageData);
                $imported['pages']++;
            }
        }

        if (isset($data['blog_categories'])) {
            foreach ($data['blog_categories'] as $catData) {
                BlogCategory::updateOrCreate(['id' => $catData['id']], $catData);
                $imported['blog_categories']++;
            }
        }

        if (isset($data['blog_posts'])) {
            foreach ($data['blog_posts'] as $postData) {
                unset($postData['category'], $postData['featured_image']);
                BlogPost::updateOrCreate(['id' => $postData['id']], $postData);
                $imported['blog_posts']++;
            }
        }

        if (isset($data['media'])) {
            foreach ($data['media'] as $mediaData) {
                Media::updateOrCreate(['id' => $mediaData['id']], $mediaData);
                $imported['media']++;
            }
        }

        if (isset($data['theme_settings'])) {
            foreach ($data['theme_settings'] as $settingData) {
                ThemeSetting::updateOrCreate(['id' => $settingData['id']], $settingData);
                $imported['theme_settings']++;
            }
        }

        ActivityLogger::log('backup_imported', 'Backup imported: ' . json_encode($imported));

        return back()->with('success', 'Backup imported. ' . $imported['pages'] . ' pages, ' . $imported['blog_posts'] . ' posts, ' . $imported['blog_categories'] . ' categories, ' . $imported['media'] . ' media, ' . $imported['theme_settings'] . ' theme settings restored.');
    }
}
