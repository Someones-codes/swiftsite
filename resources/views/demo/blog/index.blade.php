@extends('layouts.demo')

@section('title', 'Family Link Blog')
@section('demo-icon', '📝')
@section('demo-name', 'Family Link Blog')


@push('styles')
<style>
    /* ============================================
       DEMO APPS — SHARED STYLES (inlined)
       Finance Tracker / Water Tracker / Family Blog
       Cloud Sky (#CBDDE9) + Ocean Blue (#2872A1)
       ============================================ */

    :root {
        --sky: #CBDDE9;
        --ocean: #2872A1;
        --ocean-dark: #1e5a8e;
        --dark: #1a3a52;
        --light: #f8fbfd;
        --gray: #6b7280;
        --border: #e2e8f0;
        --green: #059669;
        --red: #c62828;
        --radius: 12px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        overflow-x: hidden;
    }

    /* ============================================
       NAVBAR — links back to portfolio home
       ============================================ */
    .demo-back-nav {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #ffffff;
        border-bottom: 1px solid var(--border);
        padding: 0 5%;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(40, 114, 161, 0.08);
    }

    .demo-back-link {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--ocean);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .demo-back-link:hover {
        color: var(--dark);
    }

    .demo-back-link svg {
        flex-shrink: 0;
    }

    .demo-app-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        color: var(--dark);
        font-size: 0.95rem;
    }

    .demo-live-badge {
        background: var(--ocean);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ============================================
       FLASH MESSAGES
       ============================================ */
    .demo-flash {
        padding: 12px 5%;
        font-size: 0.9rem;
        font-weight: 500;
        text-align: center;
    }

    .demo-flash.success { background: #ecfdf5; color: #065f46; }
    .demo-flash.error   { background: #fef2f2; color: #991b1b; }

    /* ============================================
       PAGE WRAPPER
       ============================================ */
    .demo-page-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 24px 5% 80px;
        width: 100%;
    }

    .demo-page-header {
        margin-bottom: 20px;
    }

    .demo-page-header h1 {
        font-size: clamp(1.4rem, 4vw, 1.8rem);
        color: var(--dark);
        margin: 0 0 6px;
        font-weight: 800;
    }

    .demo-page-header p {
        font-size: 0.9rem;
        color: var(--gray);
        margin: 0;
    }

    .reset-notice {
        background: var(--sky);
        border: 1px solid #b5cfe0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.8rem;
        color: var(--dark);
        margin-bottom: 20px;
        word-break: break-word;
    }

    /* ============================================
       STAT CARDS
       ============================================ */
    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 18px;
    }

    .stat-card .label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray);
    }

    .stat-card .value {
        font-size: 1.5rem;
        font-weight: 800;
        margin-top: 4px;
        word-break: break-word;
    }

    .stat-card.income .value  { color: var(--green); }
    .stat-card.expense .value { color: var(--red); }
    .stat-card.balance .value { color: var(--ocean); }

    /* ============================================
       CARDS
       ============================================ */
    .card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .card-header {
        padding: 14px 18px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
    }

    .card-header h2 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .card-body {
        padding: 18px;
    }

    /* ============================================
       FORMS
       ============================================ */
    .form-group {
        margin-bottom: 14px;
    }

    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--dark);
        background: white;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--ocean);
        box-shadow: 0 0 0 3px rgba(40, 114, 161, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 70px;
    }

    /* ============================================
       BUTTONS
       ============================================ */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: all 0.2s;
    }

    .btn-primary { background: var(--ocean); color: white; }
    .btn-primary:hover { background: var(--ocean-dark); }

    .btn-success { background: var(--green); color: white; }
    .btn-success:hover { background: #047857; }

    .btn-danger { background: var(--red); color: white; }
    .btn-danger:hover { background: #a31f1f; }

    .btn-sm { padding: 6px 12px; font-size: 0.75rem; }
    .btn-full { width: 100%; }

    /* ============================================
       BADGES
       ============================================ */
    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-pending  { background: #fef3c7; color: #92400e; }
    .badge-partial  { background: #dbeafe; color: #1e40af; }
    .badge-complete { background: #d1fae5; color: #065f46; }

    /* ============================================
       AMOUNTS
       ============================================ */
    .amount-positive { color: var(--green); }
    .amount-negative { color: var(--red); }

    /* ============================================
       GENERIC RESPONSIVE GRID HELPERS
       ============================================ */
    .finance-grid,
    .water-grid,
    .blog-layout {
        display: grid;
        gap: 20px;
    }

    .finance-grid     { grid-template-columns: 1fr 1.5fr; }
    .water-grid       { grid-template-columns: 1.2fr 2fr; }
    .blog-layout      { grid-template-columns: 2fr 1fr; align-items: start; }

    /* ============================================
       EMPTY STATES
       ============================================ */
    .empty-tx,
    .no-customers,
    .no-posts {
        text-align: center;
        padding: 40px 16px;
        color: var(--gray);
    }

    .empty-tx .e-icon,
    .no-customers .icon,
    .no-posts .icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    /* ============================================
       RESPONSIVE — TABLET (≤ 900px)
       ============================================ */
    @media (max-width: 900px) {
        .finance-grid,
        .water-grid,
        .blog-layout {
            grid-template-columns: 1fr;
        }

        .write-post-card {
            position: static;
        }
    }

    /* ============================================
       RESPONSIVE — MOBILE (≤ 768px)
       ============================================ */
    @media (max-width: 768px) {
        .demo-back-nav {
            padding: 0 16px;
            height: 56px;
        }

        .demo-back-link span.label-text {
            display: none;
        }

        .demo-app-title span.app-name-text {
            display: none;
        }

        .demo-page-wrap {
            padding: 18px 16px 60px;
        }

        .stat-cards {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .stat-card {
            padding: 14px;
        }

        .stat-card .value {
            font-size: 1.2rem;
        }

        .card-body {
            padding: 14px;
        }

        .reset-notice {
            font-size: 0.75rem;
        }

        .tab-bar {
            overflow-x: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .tab-bar::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            flex-shrink: 0;
        }

        .add-payment-form {
            grid-template-columns: 1fr !important;
        }

        .post-article-header,
        .post-article-body,
        .post-actions-bar,
        .comments-header,
        .comment-item,
        .add-comment-form {
            padding-left: 18px !important;
            padding-right: 18px !important;
        }

        .post-article-title {
            font-size: 1.4rem !important;
        }
    }

    /* ============================================
       RESPONSIVE — SMALL MOBILE (≤ 420px)
       ============================================ */
    @media (max-width: 420px) {
        .stat-cards {
            grid-template-columns: 1fr;
        }

        .demo-page-header h1 {
            font-size: 1.25rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* ============================================
       PAGE-SPECIFIC STYLES (Family Link Blog)
       ============================================ */
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