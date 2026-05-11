<?php

namespace App\Http\Controllers\Demo\Blog;
 
use App\Http\Controllers\Controller;
use App\Models\Demo\Blog\BlogComment;
use Illuminate\Http\Request;
 
class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:50',
            'content'     => 'required|string|min:2|max:1000',
        ]);
 
        $validated['demo_session_id'] = session('demo_session_id');
        $validated['blog_post_id']    = $postId;
 
        BlogComment::create($validated);
 
        return redirect()->route('demo.blog.posts.show', $postId)
            ->with('success', 'Comment posted!');
    }
}
