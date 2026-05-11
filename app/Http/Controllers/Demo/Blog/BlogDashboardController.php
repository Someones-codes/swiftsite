<?php

namespace App\Http\Controllers\Demo\Blog;
 
use App\Http\Controllers\Controller;
use App\Models\Demo\Blog\BlogPost;
 
class BlogDashboardController extends Controller
{
    public function index()
    {
        // Show ALL session posts in the feed (community feel)
        $posts = BlogPost::with('comments')
            ->where('demo_session_id', session('demo_session_id'))
            ->latest()
            ->get();
 
        return view('demo.blog.index', compact('posts'));
    }
}
 
