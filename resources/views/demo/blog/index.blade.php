@extends('layouts.demo')

@section('title', 'Family Link Blog')
@section('demo-icon', '📝')
@section('demo-name', 'Family Link Blog')

@section('demo-nav')
    <li><a href="{{ route('demo.blog.index') }}" class="active">Feed</a></li>
    <li><a href="{{ route('demos') }}">← All Demos</a></li>
@endsection

@push('styles')
<style>
    :root { --purple: #6a1b9a; --purple-light: #f3e5f5; }

    .blog-layout { display:grid; grid-template-columns:2fr 1fr; gap:24px; align-items:start; }

    .post-card {
        background:white; border-radius:14px; border:1px solid var(--border);
        margin-bottom:18px; overflow:hidden; transition:all 0.2s;
    }
    .post-card:hover { box-shadow:0 6px 20px rgba(106,27,154,0.1); }

    .post-header { padding:18px 20px 12px; }

    .post-author {
        display:flex; align-items:center; gap:10px; margin-bottom:12px;
    }

    .author-avatar {
        width:38px; height:38px; border-radius:50%;
        background:linear-gradient(135deg,var(--purple),#ab47bc);
        display:flex; align-items:center; justify-content:center;
        color:white; font-weight:700; font-size:15px; flex-shrink:0;
    }

    .author-info strong { display:block; font-size:14px; color:var(--dark); }
    .author-info small  { font-size:12px; color:var(--gray); }

    .post-title {
        font-family:'Sora',sans-serif; font-size:18px; font-weight:700;
        color:var(--navy); margin-bottom:8px; line-height:1.3;
    }

    .post-title a { color:inherit; transition:color 0.2s; }
    .post-title a:hover { color:var(--purple); }

    .post-body {
        font-size:14px; color:var(--gray); line-height:1.7; margin-bottom:0;
    }

    .post-footer {
        padding:12px 20px;
        border-top:1px solid var(--border);
        display:flex; align-items:center; justify-content:space-between;
        background:var(--light);
    }

    .post-actions { display:flex; align-items:center; gap:8px; }

    .like-btn {
        display:inline-flex; align-items:center; gap:6px;
        background:none; border:1.5px solid var(--border);
        padding:6px 14px; border-radius:30px; cursor:pointer;
        font-size:13px; font-weight:600; color:var(--gray);
        transition:all 0.2s; font-family:'DM Sans',sans-serif;
    }
    .like-btn:hover { border-color:var(--red); color:var(--red); background:#fef2f2; }

    .comment-count {
        font-size:13px; color:var(--gray); display:flex; align-items:center; gap:5px;
    }

    .read-more {
        font-size:13px; font-weight:600; color:var(--purple); transition:color 0.2s;
    }
    .read-more:hover { color:var(--navy2); }

    .write-post-card { position:sticky; top:76px; }

    .no-posts {
        text-align:center; padding:56px 20px;
        background:white; border-radius:14px; border:1px solid var(--border);
    }
    .no-posts .icon { font-size:52px; margin-bottom:14px; }

    .sidebar-tip {
        background:linear-gradient(135deg,var(--purple),#8e24aa);
        border-radius:12px; padding:20px; color:white; margin-top:16px;
    }
    .sidebar-tip p { font-size:13px; opacity:0.85; margin-bottom:12px; }
    .sidebar-tip a {
        background:white; color:var(--purple);
        padding:8px 16px; border-radius:8px;
        font-weight:700; font-size:13px; display:inline-block;
    }
</style>
@endpush

@section('content')

<div class="demo-page-header">
    <h1>📝 Family Link Blog</h1>
    <p>Write posts, share thoughts, like and comment. A simple community blogging platform.</p>
</div>

<div class="reset-notice">
    ⏱ Demo data resets every 30 minutes · Write a post and see how the feed updates instantly.
</div>

<div class="blog-layout">

    {{-- LEFT: POST FEED --}}
    <div>
        @forelse($posts as $post)
        <div class="post-card">
            <div class="post-header">
                <div class="post-author">
                    <div class="author-avatar">{{ substr($post->author_name, 0, 1) }}</div>
                    <div class="author-info">
                        <strong>{{ $post->author_name }}</strong>
                        <small>{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="post-title">
                    <a href="{{ route('demo.blog.posts.show', $post->id) }}">{{ $post->title }}</a>
                </div>
                <p class="post-body">{{ Str::limit($post->body, 200) }}</p>
            </div>
            <div class="post-footer">
                <div class="post-actions">
                    {{-- Like Button --}}
                    <form action="{{ route('demo.blog.posts.like', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="like-btn">
                            ❤️ {{ $post->likes }} {{ $post->likes === 1 ? 'Like' : 'Likes' }}
                        </button>
                    </form>
                    <span class="comment-count">
                        💬 {{ $post->comments->count() }} {{ $post->comments->count() === 1 ? 'comment' : 'comments' }}
                    </span>
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <a href="{{ route('demo.blog.posts.show', $post->id) }}" class="read-more">Read more →</a>
                    {{-- Author can delete their own posts (we check by session) --}}
                    @if($post->demo_session_id === session('demo_session_id'))
                    <form action="{{ route('demo.blog.posts.destroy', $post->id) }}" method="POST"
                          onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:none;border:none;color:var(--gray);cursor:pointer;font-size:13px;">
                            🗑 Delete
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="no-posts">
            <div class="icon">📭</div>
            <p style="font-size:16px;font-weight:700;color:var(--navy);margin-bottom:8px;">No posts yet!</p>
            <p style="font-size:14px;color:var(--gray);">Be the first to write something. Use the form on the right to create your first post.</p>
        </div>
        @endforelse
    </div>

    {{-- RIGHT: WRITE A POST + SIDEBAR --}}
    <div>
        <div class="card write-post-card">
            <div class="card-header" style="background:linear-gradient(135deg,var(--purple),#8e24aa);border-bottom:none;">
                <h2 style="color:white;">✍️ Write a Post</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('demo.blog.posts.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="author_name" class="form-control"
                               placeholder="e.g. Sipho Nkosi"
                               value="{{ old('author_name') }}" required maxlength="50">
                        @error('author_name') <div style="font-size:12px;color:var(--red);margin-top:4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Post Title</label>
                        <input type="text" name="title" class="form-control"
                               placeholder="What's on your mind?"
                               value="{{ old('title') }}" required maxlength="150">
                        @error('title') <div style="font-size:12px;color:var(--red);margin-top:4px;">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Your Post</label>
                        <textarea name="body" class="form-control" rows="5"
                                  placeholder="Share your thoughts, news, a story..."
                                  required minlength="10" maxlength="3000">{{ old('body') }}</textarea>
                        @error('body') <div style="font-size:12px;color:var(--red);margin-top:4px;">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-full" style="background:var(--purple);color:white;">
                        📤 Publish Post
                    </button>
                </form>
            </div>
        </div>

        <div class="sidebar-tip">
            <div style="font-size:24px;margin-bottom:8px;">💡</div>
            <p>Want a blog or community platform like this for your organisation, church, or business?</p>
            <a href="{{ route('contact') }}?ref=demo-blog">Get One Built →</a>
        </div>
    </div>

</div>

@endsection