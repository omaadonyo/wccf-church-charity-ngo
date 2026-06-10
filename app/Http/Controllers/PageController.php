<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->where('published', true)->firstOrFail();

        return view('public.page', ['page' => $page]);
    }

    public function fallback(Request $request): View
    {
        $slug = trim($request->path(), '/');

        $page = Page::where('slug', $slug)->where('published', true)->firstOrFail();

        return view('public.page', ['page' => $page]);
    }
}
