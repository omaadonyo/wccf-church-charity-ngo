<?php

use App\Helpers\ActivityLogger;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Media;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard', [
        'totalPages' => Page::count(),
        'totalBlogPosts' => BlogPost::count(),
        'totalMedia' => Media::count(),
        'totalUsers' => \App\Models\User::count(),
        'totalPageViews' => \App\Models\PageView::count(),
        'totalActivities' => \App\Models\ActivityLog::count(),
        'recentActivities' => \App\Models\ActivityLog::with('user')->latest()->take(10)->get(),
        'pageViewsLastWeek' => \App\Models\PageView::where('visited_at', '>=', now()->subDays(7))->count(),
        'pageViewsToday' => \App\Models\PageView::where('visited_at', '>=', now()->startOfDay())->count(),
        'recentUsers' => \App\Models\User::latest()->take(5)->get(),
        'activeSessions' => \Illuminate\Support\Facades\DB::table('sessions')->whereNotNull('user_id')->count(),
        'topPages' => \App\Models\PageView::select('url', \Illuminate\Support\Facades\DB::raw('count(*) as total'))->groupBy('url')->orderByDesc('total')->take(5)->get(),
    ])->name('dashboard');

    // Pages
    Route::get('/pages', fn () => view('admin.pages.index', ['pages' => Page::latest()->paginate(20)]))->name('pages.index');
    Route::get('/pages/create', fn () => view('admin.pages.form', ['page' => null, 'pageRoutes' => collect(\Illuminate\Support\Facades\Route::getRoutes()->getRoutesByName())->keys()->filter(fn ($n) => str_starts_with($n, 'admin.') === false)->values()]))->name('pages.create');
    Route::post('/pages', function (Request $request) {
        $data = $request->validate(['title' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:pages', 'route_name' => 'nullable|string|max:255', 'content' => 'nullable|json', 'meta_title' => 'nullable|string|max:255', 'meta_description' => 'nullable|string', 'published' => 'boolean']);
        $data['content'] = json_decode($data['content'] ?? '{}', true);
        $page = Page::create($data);
        ActivityLogger::log('page_created', 'Page "' . $page->title . '" created');
        return redirect()->route('admin.pages.index')->with('success', 'Page created.');
    })->name('pages.store');
    Route::get('/pages/{page}/builder', fn (Page $page) => view('admin.pages.builder', ['page' => $page, 'mediaItems' => \App\Models\Media::latest()->get()]))->name('pages.builder');
    Route::get('/pages/{page}/edit', fn (Page $page) => view('admin.pages.form', ['page' => $page, 'pageRoutes' => collect(\Illuminate\Support\Facades\Route::getRoutes()->getRoutesByName())->keys()->filter(fn ($n) => str_starts_with($n, 'admin.') === false)->values()]))->name('pages.edit');
    Route::put('/pages/{page}', function (Request $request, Page $page) {
        $data = $request->validate(['title' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id, 'route_name' => 'nullable|string|max:255', 'content' => 'nullable|json', 'meta_title' => 'nullable|string|max:255', 'meta_description' => 'nullable|string', 'published' => 'boolean']);
        $data['content'] = json_decode($data['content'] ?? '{}', true);
        $page->update($data);
        ActivityLogger::log('page_updated', 'Page "' . $page->title . '" updated');
        return redirect()->route('admin.pages.index')->with('success', 'Page updated.');
    })->name('pages.update');
    Route::post('/pages/{page}/sections', function (Request $request, Page $page) {
        $data = $request->validate(['sections' => 'required|json']);
        $page->update(['content' => json_decode($data['sections'], true)]);
        ActivityLogger::log('page_content_saved', 'Page "' . $page->title . '" sections saved');
        return response()->json(['success' => true]);
    })->name('pages.sections.save');
    Route::delete('/pages/{page}', function (Page $page) {
        $title = $page->title;
        $page->delete();
        ActivityLogger::log('page_deleted', 'Page "' . $title . '" deleted');
        return back()->with('success', 'Page deleted.');
    })->name('pages.destroy');

    // Menus
    Route::get('/menus', fn () => view('admin.menus.index', ['menus' => Menu::with('rootItems.children')->get()]))->name('menus.index');
    Route::get('/menus/{menu}/edit', fn (Menu $menu) => view('admin.menus.edit', ['menu' => $menu->load('rootItems.children'), 'availableRoutes' => collect(\Illuminate\Support\Facades\Route::getRoutes()->getRoutesByName())->keys()->filter(fn ($n) => str_starts_with($n, 'admin.') === false)->values()]))->name('menus.edit');
    Route::post('/menus/{menu}/items', function (Request $request, Menu $menu) {
        $data = $request->validate(['label' => 'required|string|max:255', 'url' => 'nullable|string|max:255', 'route_name' => 'nullable|string|max:255', 'parent_id' => 'nullable|exists:menu_items,id', 'target' => 'nullable|string|max:20', 'sort_order' => 'nullable|integer']);
        $data['menu_id'] = $menu->id;
        $data['sort_order'] ??= MenuItem::where('menu_id', $menu->id)->max('sort_order') + 1;
        MenuItem::create($data);
        ActivityLogger::log('menu_updated', 'Menu "' . $menu->name . '" item added');
        return back()->with('success', 'Menu item added.');
    })->name('menus.items.store');
    Route::put('/menu-items/{item}', function (Request $request, MenuItem $item) {
        $data = $request->validate(['label' => 'required|string|max:255', 'url' => 'nullable|string|max:255', 'route_name' => 'nullable|string|max:255', 'target' => 'nullable|string|max:20', 'sort_order' => 'nullable|integer']);
        $item->update($data);
        ActivityLogger::log('menu_updated', 'Menu item "' . $item->label . '" updated');
        return back()->with('success', 'Menu item updated.');
    })->name('menu-items.update');
    Route::delete('/menu-items/{item}', function (MenuItem $item) {
        $label = $item->label;
        $item->delete();
        ActivityLogger::log('menu_updated', 'Menu item "' . $label . '" deleted');
        return back()->with('success', 'Menu item deleted.');
    })->name('menu-items.destroy');

    // Theme
    Route::get('/theme', fn () => view('admin.theme.index', ['settings' => ThemeSetting::all()->keyBy('key')]))->name('theme.index');
    Route::post('/theme', function (Request $request) {
        foreach ($request->except('_token') as $key => $value) {
            if (str_starts_with($key, 'theme_')) {
                ThemeSetting::setValue($key, $value);
            }
        }
        ActivityLogger::log('theme_updated', 'Theme settings saved');
        return back()->with('success', 'Theme settings saved.');
    })->name('theme.update');

    // Media
    Route::get('/media', fn () => view('admin.media.index', ['media' => \App\Models\Media::latest()->paginate(30)]))->name('media.index');
    Route::get('/media/json', fn () => response()->json(\App\Models\Media::latest()->get(['id', 'name', 'file_path', 'size'])->map(fn ($m) => ['id' => $m->id, 'name' => $m->name, 'url' => $m->url, 'size' => $m->size_formatted])))->name('media.json');
    Route::post('/media/upload', function (Request $request) {
        $request->validate(['file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,webm,ogg|max:102400']);
        $file = $request->file('file');
        $path = $file->store('media', 'public');
        $media = \App\Models\Media::create(['name' => $file->getClientOriginalName(), 'file_path' => $path, 'file_type' => $file->getClientOriginalExtension(), 'mime_type' => $file->getMimeType(), 'size' => $file->getSize()]);
        ActivityLogger::log('media_uploaded', 'File "' . $media->name . '" uploaded (' . $media->size_formatted . ')');
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'url' => $media->url, 'id' => $media->id]);
        }
        return back()->with('success', 'File uploaded.');
    })->name('media.upload');
    Route::delete('/media/{medium}', function (\App\Models\Media $medium) {
        $name = $medium->name;
        $medium->delete();
        ActivityLogger::log('media_deleted', 'File "' . $name . '" deleted');
        return back()->with('success', 'File deleted.');
    })->name('media.destroy');

    // Blog
    Route::get('/blog', fn () => view('admin.blog.index', ['posts' => BlogPost::with('category', 'author', 'featuredImage')->latest()->paginate(20)]))->name('blog.index');
    Route::get('/blog/create', fn () => view('admin.blog.form', ['post' => null, 'categories' => BlogCategory::all(), 'mediaItems' => Media::latest()->get()]))->name('blog.create');
    Route::post('/blog', function (Request $request) {
        $data = $request->validate(['title' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:blog_posts', 'content' => 'nullable|string', 'excerpt' => 'nullable|string', 'featured_image_id' => 'nullable|exists:media,id', 'blog_category_id' => 'nullable|exists:blog_categories,id', 'published' => 'boolean']);
        $data['author_id'] = $request->user()->id;
        $data['published_at'] = ($data['published'] ?? false) ? now() : null;
        BlogPost::create($data);
        ActivityLogger::log('blog_created', 'Post "' . $data['title'] . '" created');
        return redirect()->route('admin.blog.index')->with('success', 'Post created.');
    })->name('blog.store');
    Route::get('/blog/{post}/edit', fn (BlogPost $post) => view('admin.blog.form', ['post' => $post, 'categories' => BlogCategory::all(), 'mediaItems' => Media::latest()->get()]))->name('blog.edit');
    Route::put('/blog/{post}', function (Request $request, BlogPost $post) {
        $data = $request->validate(['title' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $post->id, 'content' => 'nullable|string', 'excerpt' => 'nullable|string', 'featured_image_id' => 'nullable|exists:media,id', 'blog_category_id' => 'nullable|exists:blog_categories,id', 'published' => 'boolean']);
        $data['published_at'] = ($data['published'] ?? false) && !$post->published ? now() : $post->published_at;
        $post->update($data);
        ActivityLogger::log('blog_updated', 'Post "' . $post->title . '" updated');
        return redirect()->route('admin.blog.index')->with('success', 'Post updated.');
    })->name('blog.update');
    Route::delete('/blog/{post}', function (BlogPost $post) {
        $title = $post->title;
        $post->delete();
        ActivityLogger::log('blog_deleted', 'Post "' . $title . '" deleted');
        return redirect()->route('admin.blog.index')->with('success', 'Post deleted.');
    })->name('blog.destroy');

    // Blog categories
    Route::get('/blog/categories', fn () => view('admin.blog.categories', ['categories' => BlogCategory::withCount('posts')->latest()->get()]))->name('blog.categories');
    Route::post('/blog/categories', function (Request $request) {
        $data = $request->validate(['name' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:blog_categories']);
        BlogCategory::create($data);
        ActivityLogger::log('category_created', 'Category "' . $data['name'] . '" created');
        return back()->with('success', 'Category created.');
    })->name('blog.categories.store');
    Route::put('/blog/categories/{category}', function (Request $request, BlogCategory $category) {
        $data = $request->validate(['name' => 'required|string|max:255', 'slug' => 'required|string|max:255|unique:blog_categories,slug,' . $category->id]);
        $category->update($data);
        ActivityLogger::log('category_updated', 'Category "' . $data['name'] . '" updated');
        return back()->with('success', 'Category updated.');
    })->name('blog.categories.update');
    Route::delete('/blog/categories/{category}', function (BlogCategory $category) {
        $name = $category->name;
        $category->delete();
        ActivityLogger::log('category_deleted', 'Category "' . $name . '" deleted');
        return back()->with('success', 'Category deleted.');
    })->name('blog.categories.destroy');
});
