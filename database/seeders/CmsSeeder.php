<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\ThemeSetting;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        // Make first user admin
        User::first()?->update(['is_admin' => true]);

        // Theme defaults
        $defaults = [
            ['key' => 'theme_primary_color', 'value' => '#c0392b'],
            ['key' => 'theme_secondary_color', 'value' => '#0f1b2d'],
            ['key' => 'theme_heading_font', 'value' => 'Rubik'],
            ['key' => 'theme_body_font', 'value' => 'Lato'],
            ['key' => 'theme_logo_url', 'value' => ''],
            ['key' => 'theme_favicon_url', 'value' => ''],
        ];
        foreach ($defaults as $setting) {
            ThemeSetting::firstOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }

        // Default pages
        $pages = [
            ['title' => 'Home', 'slug' => 'home', 'route_name' => 'home', 'published' => true],
            ['title' => 'Who We Are', 'slug' => 'who-we-are', 'route_name' => 'who-we-are', 'published' => true],
            ['title' => 'What We Do', 'slug' => 'what-we-do', 'route_name' => 'what-we-do', 'published' => true],
            ['title' => 'Get Involved', 'slug' => 'get-involved', 'route_name' => 'get-involved', 'published' => true],
            ['title' => 'Donate', 'slug' => 'donate', 'route_name' => 'donate', 'published' => true],
        ];
        foreach ($pages as $page) {
            Page::firstOrCreate(['slug' => $page['slug']], $page);
        }

        // Main navigation menu
        $mainMenu = Menu::firstOrCreate(
            ['location' => 'main_nav'],
            ['name' => 'Main Navigation', 'location' => 'main_nav']
        );
        if ($mainMenu->rootItems()->count() === 0) {
            $items = [
                ['label' => 'Home', 'route_name' => 'home', 'sort_order' => 0],
                ['label' => 'Who We Are', 'route_name' => 'who-we-are', 'sort_order' => 1],
                ['label' => 'What We Do', 'route_name' => 'what-we-do', 'sort_order' => 2],
                ['label' => 'Get Involved', 'route_name' => 'get-involved', 'sort_order' => 3],
                ['label' => 'Donate', 'route_name' => 'donate', 'sort_order' => 4],
            ];
            foreach ($items as $item) {
                $mainMenu->items()->create($item);
            }
        }

        if (BlogCategory::count() === 0) {
            BlogCategory::create(['name' => 'Devotional', 'slug' => 'devotional']);
            BlogCategory::create(['name' => 'Church News', 'slug' => 'church-news']);
            BlogCategory::create(['name' => 'Outreach', 'slug' => 'outreach']);
            BlogCategory::create(['name' => 'Testimonies', 'slug' => 'testimonies']);
        }
    }
}
