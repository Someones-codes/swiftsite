@extends('layouts.app')
@section('title', 'Live Demos')

@push('styles')
<style>
    .demos-hero {
        background: linear-gradient(135deg, var(--dark) 0%, var(--navy2) 60%, #1e5a8e 100%);
        padding: 72px 5%; text-align: center; position: relative; overflow: hidden;
    }

    .demos-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 70% 30%, rgba(203,221,233,0.25) 0%, transparent 60%);
    }

    .demos-hero h1 {
        font-size: clamp(32px,5vw,56px); color: white; margin-bottom: 14px;
        position: relative;
    }

    .demos-hero h1 span { color: var(--gold); }

    .demos-hero p {
        font-size: 18px; color: rgba(255,255,255,0.75);
        max-width: 560px; margin: 0 auto 28px;
        position: relative;
    }

    .demos-notice {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
        border-radius: 30px; padding: 8px 18px;
        font-size: 13px; color: rgba(255,255,255,0.8);
        position: relative;
    }

    /* ── DEMO CARDS ── */
    .demos-section {
        padding: 64px 5%;
        max-width: 1160px; margin: 0 auto;
    }

    .demos-grid {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;
    }

    .demo-card {
        background: white; border-radius: 20px;
        border: 1px solid var(--border); overflow: hidden;
        transition: all 0.3s; display: flex; flex-direction: column;
    }

    .demo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(13,27,75,0.14);
    }

    .demo-card-hero {
        padding: 40px 28px 28px; text-align: center;
        position: relative;
    }

    .demo-card-hero.finance  { background: linear-gradient(135deg, #1a3a52, #2872A1); }
    .demo-card-hero.water    { background: linear-gradient(135deg, #0d4b3a, #00897b); }
    .demo-card-hero.blog     { background: linear-gradient(135deg, #2872A1, #4a9fd1); }

    .demo-big-icon { font-size: 64px; margin-bottom: 16px; line-height: 1; }

    .demo-card-hero h2 {
        font-size: 20px; font-weight: 800; color: white; margin-bottom: 6px;
    }

    .demo-card-hero p { font-size: 14px; color: rgba(255,255,255,0.65); }

    .demo-live-tag {
        position: absolute; top: 14px; right: 14px;
        background: rgba(255,255,255,0.15); color: white;
        font-size: 10px; font-weight: 700; padding: 4px 10px;
        border-radius: 20px; text-transform: uppercase; letter-spacing: 1px;
        display: flex; align-items: center; gap: 5px;
    }

    .live-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #4caf50; animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }

    .demo-card-body {
        padding: 24px 28px 28px; flex: 1;
        display: flex; flex-direction: column;
    }

    .demo-features {
        list-style: none; margin-bottom: 24px; flex: 1;
    }

    .demo-features li {
        display: flex; align-items: flex-start; gap: 10px;
        font-size: 14px; color: var(--gray); padding: 7px 0;
        border-bottom: 1px solid var(--border);
    }

    .demo-features li:last-child { border-bottom: none; }

    .demo-features li .tick {
        color: #059669; font-weight: 700; font-size: 13px;
        margin-top: 1px; flex-shrink: 0;
    }

    .demo-tech-stack {
        display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 20px;
    }

    .tech-chip {
        background: var(--light); color: var(--navy2);
        font-size: 11px; font-weight: 600; padding: 4px 10px;
        border-radius: 20px; border: 1px solid var(--border);
    }

    .demo-try-btn {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; padding: 14px; border-radius: 12px;
        font-size: 15px; font-weight: 700;
        transition: all 0.2s;
    }

    .demo-try-btn.finance { background: #2872A1; color: white; }
    .demo-try-btn.finance:hover { background: #1a3a52; }
 
    .demo-try-btn.water { background: #00897b; color: white; }
    .demo-try-btn.water:hover { background: #00695c; }
 
    .demo-try-btn.blog { background: #4a9fd1; color: white; }
    .demo-try-btn.blog:hover { background: #2872A1; }

    /* ── HOW IT WORKS ── */
    .how-section {
        background: var(--light); padding: 56px 5%;
    }

    .how-section h2 {
        text-align: center; font-size: 28px; font-weight: 800;
        color: var(--navy); margin-bottom: 40px;
    }

    .how-grid {
        max-width: 800px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
    }

    .how-item { text-align: center; }

    .how-num {
        width: 48px; height: 48px; border-radius: 50%;
        background: var(--navy2); color: white;
        font-family: 'Sora', sans-serif; font-weight: 800; font-size: 18px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
    }

    .how-item h4 { font-size: 15px; font-weight: 700; color: var(--navy); margin-bottom: 6px; }
    .how-item p  { font-size: 13px; color: var(--gray); line-height: 1.6; }

    /* ── CTA ── */
    .demos-cta {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
        padding: 64px 5%; text-align: center;
    }

    .demos-cta h2 { font-size: clamp(24px,4vw,40px); color: white; margin-bottom: 12px; }
    .demos-cta p  { font-size: 16px; color: rgba(255,255,255,0.7); max-width: 480px; margin: 0 auto 28px; }

    @media (max-width: 900px) {
        .demos-grid { grid-template-columns: 1fr; }
        .how-grid   { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<div class="demos-hero">
    <div class="section-label" style="color:var(--gold);">Live & Interactive</div>
    <h1>Real Systems,<br>Try Them <span>Right Now</span></h1>
    <p>Not screenshots. Not mockups. Fully working web applications you can use — built by Prince Chishanga to show what's possible.</p>
    <div class="demos-notice">
        🔬 All demos reset every 30 minutes · Your session data is private
    </div>
</div>

{{-- DEMO CARDS --}}
<div class="demos-section">
    <div class="demos-grid">

        {{-- FINANCE TRACKER --}}
        <div class="demo-card">
            <div class="demo-card-hero finance">
                <div class="demo-live-tag"><div class="live-dot"></div> Live</div>
                <div class="demo-big-icon">📊</div>
                <h2>Student Finance Tracker</h2>
                <p>Budgeting & expense management</p>
            </div>
            <div class="demo-card-body">
                <ul class="demo-features">
                    <li><span class="tick">✓</span> Add income from any source (NSFAS, job, family)</li>
                    <li><span class="tick">✓</span> Log expenses by category (food, rent, transport)</li>
                    <li><span class="tick">✓</span> Real-time balance calculation</li>
                    <li><span class="tick">✓</span> Full transaction history</li>
                    <li><span class="tick">✓</span> Delete entries instantly</li>
                </ul>
                <div class="demo-tech-stack">
                    <span class="tech-chip">Laravel</span>
                    <span class="tech-chip">MySQL</span>
                    <span class="tech-chip">PHP</span>
                    <span class="tech-chip">Sessions</span>
                </div>
                <a href="{{ route('demo.finance.index') }}" class="demo-try-btn finance">
                    📊 Open Finance Tracker →
                </a>
            </div>
        </div>

        {{-- WATER DRUM TRACKER --}}
        <div class="demo-card">
            <div class="demo-card-hero water">
                <div class="demo-live-tag"><div class="live-dot"></div> Live</div>
                <div class="demo-big-icon">💧</div>
                <h2>Water Drum Tracker</h2>
                <p>Customer & payment management</p>
            </div>
            <div class="demo-card-body">
                <ul class="demo-features">
                    <li><span class="tick">✓</span> Add customers with drum orders</li>
                    <li><span class="tick">✓</span> Track payments per customer</li>
                    <li><span class="tick">✓</span> View outstanding balances instantly</li>
                    <li><span class="tick">✓</span> Mark payments as complete</li>
                    <li><span class="tick">✓</span> Total outstanding summary</li>
                </ul>
                <div class="demo-tech-stack">
                    <span class="tech-chip">Laravel</span>
                    <span class="tech-chip">MySQL</span>
                    <span class="tech-chip">CRUD</span>
                    <span class="tech-chip">Relations</span>
                </div>
                <a href="{{ route('demo.water.index') }}" class="demo-try-btn water">
                    💧 Open Water Tracker →
                </a>
            </div>
        </div>

        {{-- BLOG --}}
        <div class="demo-card">
            <div class="demo-card-hero blog">
                <div class="demo-live-tag"><div class="live-dot"></div> Live</div>
                <div class="demo-big-icon">📝</div>
                <h2>Family Link Blog</h2>
                <p>Simple social blogging platform</p>
            </div>
            <div class="demo-card-body">
                <ul class="demo-features">
                    <li><span class="tick">✓</span> Create and publish posts instantly</li>
                    <li><span class="tick">✓</span> Browse community post feed</li>
                    <li><span class="tick">✓</span> Read full individual posts</li>
                    <li><span class="tick">✓</span> Like posts with one click</li>
                    <li><span class="tick">✓</span> Leave comments on posts</li>
                </ul>
                <div class="demo-tech-stack">
                    <span class="tech-chip">Laravel</span>
                    <span class="tech-chip">MySQL</span>
                    <span class="tech-chip">Blade</span>
                    <span class="tech-chip">Sessions</span>
                </div>
                <a href="{{ route('demo.blog.index') }}" class="demo-try-btn blog">
                    📝 Open Family Blog →
                </a>
            </div>
        </div>

    </div>
</div>

{{-- HOW IT WORKS --}}
<div class="how-section">
    <h2>How the Demos Work</h2>
    <div class="how-grid">
        <div class="how-item">
            <div class="how-num">1</div>
            <h4>Click "Open"</h4>
            <p>Each demo loads instantly. No login needed — you get your own private session automatically.</p>
        </div>
        <div class="how-item">
            <div class="how-num">2</div>
            <h4>Use the System</h4>
            <p>Add real data, test all features. It works exactly like a real production system would.</p>
        </div>
        <div class="how-item">
            <div class="how-num">3</div>
            <h4>Contact Me</h4>
            <p>Impressed? Click "Get a Website Like This" and tell me what system your business needs.</p>
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="demos-cta">
    <div class="section-label" style="color:var(--gold);">Ready to Start?</div>
    <h2>Want a System Like One of These?</h2>
    <p>I build custom web systems tailored to your business — finance, inventory, customers, blogs, or anything else you need.</p>
    <a href="{{ route('contact') }}?ref=demos" class="hero-btn-primary" style="background:var(--gold);color:var(--navy);padding:14px 32px;border-radius:10px;font-weight:700;font-size:15px;display:inline-flex;align-items:center;gap:8px;">
        💬 Let's Build Your System →
    </a>
</div>

@endsection