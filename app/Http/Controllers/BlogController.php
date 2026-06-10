<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category', 'author', 'featuredImage')
            ->where('published', true)
            ->latest('published_at')
            ->paginate(12);
        return view('public.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::with('category', 'author', 'featuredImage')
            ->where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();
        $recent = BlogPost::where('published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        return view('public.blog.show', compact('post', 'recent'));
    }
}
