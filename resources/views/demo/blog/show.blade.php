@extends('layouts.demo')

@section('title', $post->title)
@section('demo-icon', '📝')
@section('demo-name', 'Family Link Blog')

@section('demo-nav')
    <li><a href="{{ route('demo.blog.index') }}">← Feed</a></li>
@endsection

@push('styles')
<style>
    :root { --purple:#6a1b9a; }

    .post-single { max-width:720px; margin:0 auto; }

    .post-back { color:var(--gray); font-size:14px; margin-bottom:20px; display:inline-flex; align-items:center; gap:6px; transition:color 0.2s; }
    .post-back:hover { color:var(--purple); }

    .post-article { background:white; border-radius:16px; border:1px solid var(--border); overflow:hidden; margin-bottom:24px; }

    .post-article-header { padding:28px 32px 20px; border-bottom:1px solid var(--border); }

    .post-author-row { display:flex; align-items:center; gap:12px; margin-bottom:16px; }

    .author-avatar-lg {
        width:48px; height:48px; border-radius:50%;
        background:linear-gradient(135deg,var(--purple),#ab47bc);
        display:flex; align-items:center; justify-content:center;
        color:white; font-weight:800; font-size:18px; flex-shrink:0;
    }

    .post-article-title {
        font-family:'Sora',sans-serif; font-size:26px; font-weight:800;
        color:var(--navy); line-height:1.3; margin-bottom:0;
    }

    .post-article-body { padding:28px 32px; font-size:15px; line-height:1.85; color:var(--dark); white-space:pre-wrap; }

    .post-actions-bar {
        padding:16px 32px; border-top:1px solid var(--border);
        background:var(--light); display:flex; align-items:center; gap:12px;
    }

    .like-btn {
        display:inline-flex; align-items:center; gap:6px;
        background:white; border:1.5px solid var(--border);
        padding:8px 18px; border-radius:30px; cursor:pointer;
        font-size:14px; font-weight:600; color:var(--gray);
        transition:all 0.2s; font-family:'DM Sans',sans-serif;
    }
    .like-btn:hover { border-color:var(--red); color:var(--red); background:#fef2f2; }

    /* ── COMMENTS ── */
    .comments-section { background:white; border-radius:16px; border:1px solid var(--border); overflow:hidden; }

    .comments-header { padding:18px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:8px; }
    .comments-header h2 { font-size:16px; font-weight:700; color:var(--navy); }

    .comment-item { padding:16px 24px; border-bottom:1px solid var(--border); }
    .comment-item:last-child { border-bottom:none; }

    .comment-author-row { display:flex; align-items:center; gap:10px; margin-bottom:8px; }

    .comment-avatar {
        width:32px; height:32px; border-radius:50%;
        background:linear-gradient(135deg,var(--navy2),var(--red));
        display:flex; align-items:center; justify-content:center;
        color:white; font-weight:700; font-size:13px; flex-shrink:0;
    }

    .comment-author-name { font-size:13px; font-weight:700; color:var(--dark); }
    .comment-time { font-size:11px; color:var(--gray); }
    .comment-body { font-size:14px; color:var(--gray); line-height:1.6; }

    .add-comment-form { padding:20px 24px; border-top:1px solid var(--border); background:var(--light); }
    .add-comment-form h3 { font-size:14px; font-weight:700; color:var(--navy); margin-bottom:14px; }
</style>
@endpush

@section('content')
<div class="demo-content" style="max-width:760px;margin:0 auto;">

    <a href="{{ route('demo.blog.index') }}" class="post-back">← Back to Feed</a>

    {{-- POST --}}
    <div class="post-article">
        <div class="post-article-header">
            <div class="post-author-row">
                <div class="author-avatar-lg">{{ substr($post->author_name, 0, 1) }}</div>
                <div>
                    <div style="font-size:15px;font-weight:700;color:var(--dark);">{{ $post->author_name }}</div>
                    <div style="font-size:12px;color:var(--gray);">{{ $post->created_at->format('d M Y \a\t H:i') }} · {{ $post->created_at->diffForHumans() }}</div>
                </div>
            </div>
            <h1 class="post-article-title">{{ $post->title }}</h1>
        </div>

        <div class="post-article-body">{{ $post->body }}</div>

        <div class="post-actions-bar">
            <form action="{{ route('demo.blog.posts.like', $post->id) }}" method="POST">
                @csrf
                <button type="submit" class="like-btn">
                    ❤️ {{ $post->likes }} {{ $post->likes === 1 ? 'Like' : 'Likes' }}
                </button>
            </form>
            <span style="font-size:14px;color:var(--gray);">💬 {{ $post->comments->count() }} comments</span>

            @if($post->demo_session_id === session('demo_session_id'))
            <form action="{{ route('demo.blog.posts.destroy', $post->id) }}" method="POST"
                  style="margin-left:auto;" onsubmit="return confirm('Delete this post?')">
                @csrf @method('DELETE')
                <button type="submit" style="background:none;border:none;cursor:pointer;color:var(--gray);font-size:13px;">
                    🗑 Delete Post
                </button>
            </form>
            @endif
        </div>
    </div>

    {{-- COMMENTS --}}
    <div class="comments-section">
        <div class="comments-header">
            <h2>💬 Comments</h2>
            <span style="font-size:13px;color:var(--gray);">{{ $post->comments->count() }}</span>
        </div>

        @forelse($post->comments->sortBy('created_at') as $comment)
        <div class="comment-item">
            <div class="comment-author-row">
                <div class="comment-avatar">{{ substr($comment->author_name, 0, 1) }}</div>
                <div>
                    <div class="comment-author-name">{{ $comment->author_name }}</div>
                    <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                </div>
            </div>
            <div class="comment-body">{{ $comment->content }}</div>
        </div>
        @empty
        <div style="text-align:center;padding:32px;color:var(--gray);font-size:14px;">
            No comments yet. Be the first to respond!
        </div>
        @endforelse

        {{-- ADD COMMENT FORM --}}
        <div class="add-comment-form">
            <h3>Leave a Comment</h3>
            <form action="{{ route('demo.blog.comments.store', $post->id) }}" method="POST">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="author_name" class="form-control"
                               placeholder="Your name" required maxlength="50">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Comment</label>
                    <textarea name="content" class="form-control" rows="3"
                              placeholder="Write your comment..." required maxlength="1000"></textarea>
                </div>
                <button type="submit" class="btn" style="background:var(--purple);color:white;">
                    💬 Post Comment
                </button>
            </form>
        </div>
    </div>

</div>
@endsection