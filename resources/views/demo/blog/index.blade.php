@extends('layouts.demo')

@section('title', 'Family Link Blog')
@section('demo-icon', '📝')
@section('demo-name', 'Family Link Blog')


@push('styles')
<style>
    .balance-bar {
        height: 8px; border-radius: 10px; overflow: hidden;
        background: var(--border); margin-top: 16px;
    }
    .balance-bar-fill {
        height: 100%; border-radius: 10px;
        background: linear-gradient(90deg, #059669, #34d399);
        transition: width 0.6s ease;
    }

    .tab-bar { display:flex; gap:8px; margin-bottom:16px; }
    .tab-btn {
        padding:7px 16px; border-radius:30px; font-size:0.8rem;
        font-weight:600; border:none; cursor:pointer;
        background:var(--light); color:var(--gray);
        transition:all 0.2s; font-family:'DM Sans',sans-serif;
        white-space: nowrap;
    }
    .tab-btn.active { background:var(--ocean); color:white; }

    .tx-list { list-style:none; margin:0; padding:0; }
    .tx-item {
        display:flex; align-items:center; gap:10px;
        padding:12px 0; border-bottom:1px solid var(--border);
    }
    .tx-item:last-child { border-bottom:none; }

    .tx-icon {
        width:34px; height:34px; border-radius:50%;
        display:flex; align-items:center; justify-content:center;
        font-size:15px; flex-shrink:0;
    }
    .tx-icon.income  { background:#d1fae5; }
    .tx-icon.expense { background:#fee2e2; }

    .tx-label { flex:1; min-width: 0; }
    .tx-label strong { display:block; font-size:0.85rem; color:var(--dark); word-break: break-word; }
    .tx-label small  { font-size:0.75rem; color:var(--gray); }

    .tx-amount { font-weight:700; font-size:0.85rem; white-space:nowrap; }

    .delete-btn {
        background:none; border:none; cursor:pointer;
        color:var(--gray); font-size:14px; padding:4px 8px;
        border-radius:6px; transition:all 0.15s; flex-shrink: 0;
    }
    .delete-btn:hover { background:#fee2e2; color:var(--red); }
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


    </div>

</div>

@endsection