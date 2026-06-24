@extends('layouts.demo')

@section('title', $post->title)
@section('demo-icon', '📝')
@section('demo-name', 'Family Link Blog')

@section('demo-nav')
    <li><a href="{{ route('demo.blog.index') }}">← Feed</a></li>
@endsection

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
        --purple: #6a1b9a;
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
       PAGE-SPECIFIC STYLES (Blog Post Detail)
       ============================================ */
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