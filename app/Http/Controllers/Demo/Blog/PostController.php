<?php
// app/Http/Controllers/Demo/Blog/PostController.php

namespace App\Http\Controllers\Demo\Blog;

use App\Http\Controllers\Controller;
use App\Models\Demo\Blog\BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:50',
            'title'       => 'required|string|max:150',
            'body'        => 'required|string|min:10|max:3000',
        ]);

        $validated['demo_session_id'] = session('demo_session_id');

        BlogPost::create($validated);

        return redirect()->route('demo.blog.index')
            ->with('success', 'Post published!');
    }

    public function show($id)
    {
        $sessionId = session('demo_session_id');

        $post = BlogPost::where('id', $id)
            ->where('demo_session_id', $sessionId)
            ->with('comments')
            ->firstOrFail();

        return view('demo.blog.show', compact('post'));
    }

    public function like($id)
    {
        $sessionId = session('demo_session_id');

        BlogPost::where('id', $id)
            ->where('demo_session_id', $sessionId)
            ->increment('likes');

        return back()->with('success', 'Liked!');
    }

    public function destroy($id)
    {
        $sessionId = session('demo_session_id');

        BlogPost::where('id', $id)
            ->where('demo_session_id', $sessionId)
            ->delete();

        return redirect()->route('demo.blog.index')
            ->with('success', 'Post deleted.');
    }
}