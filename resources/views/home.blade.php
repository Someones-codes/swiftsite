@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    /* ── HERO ── */
    .hero {
        min-height: 92vh;
        display: flex; align-items: center;
        padding: 80px 5%;
        background: linear-gradient(135deg, var(--navy) 0%, #1a237e 50%, #0d1b4b 100%);
        position: relative; overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute; inset: 0;
        background:
            radial-gradient(ellipse at 80% 20%, rgba(240,165,0,0.15) 0%, transparent 60%),
            radial-gradient(ellipse at 20% 80%, rgba(198,40,40,0.12) 0%, transparent 50%);
    }

    .hero-grid {
        max-width: 1160px; margin: 0 auto; width: 100%;
        display: grid; grid-template-columns: 1fr 1fr;
        align-items: center; gap: 60px;
        position: relative; z-index: 1;
    }

    .hero-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(240,165,0,0.15); border: 1px solid rgba(240,165,0,0.3);
        color: var(--gold); padding: 6px 14px; border-radius: 20px;
        font-size: 12px; font-weight: 700; letter-spacing: 1.5px;
        text-transform: uppercase; margin-bottom: 20px;
    }

    .hero-title {
        font-size: clamp(38px, 5vw, 64px);
        color: white; line-height: 1.1; margin-bottom: 20px;
    }

    .hero-title span { color: var(--gold); }

    .hero-subtitle {
        font-size: 17px; color: rgba(255,255,255,0.7);
        line-height: 1.7; max-width: 480px; margin-bottom: 36px;
    }

    .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }

    .hero-btn-primary {
        background: var(--gold); color: var(--navy);
        padding: 14px 30px; border-radius: 10px;
        font-weight: 700; font-size: 15px;
        transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;
    }

    .hero-btn-primary:hover { background: #ffd54f; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(240,165,0,0.35); }

    .hero-btn-secondary {
        background: rgba(255,255,255,0.1); color: white;
        border: 1.5px solid rgba(255,255,255,0.25);
        padding: 14px 30px; border-radius: 10px;
        font-weight: 600; font-size: 15px;
        transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;
    }

    .hero-btn-secondary:hover { background: rgba(255,255,255,0.18); }

    /* ── HERO VISUAL ── */
    .hero-visual {
        display: flex; justify-content: center; align-items: center;
    }

    .hero-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 20px; padding: 30px;
        backdrop-filter: blur(12px);
        width: 100%; max-width: 400px;
    }

    .hero-card-header {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 20px; padding-bottom: 16px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .avatar-lg {
        width: 56px; height: 56px; border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), var(--red));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 800;
        color: white; flex-shrink: 0;
    }

    .hero-card h3 { font-size: 17px; font-weight: 700; color: white; }
    .hero-card p  { font-size: 13px; color: rgba(255,255,255,0.5); }

    .stat-row {
        display: grid; grid-template-columns: 1fr 1fr 1fr;
        gap: 12px; margin-bottom: 20px;
    }

    .hero-stat {
        background: rgba(255,255,255,0.06);
        border-radius: 10px; padding: 14px 12px;
        text-align: center;
    }

    .hero-stat .n {
        font-family: 'Sora', sans-serif;
        font-size: 26px; font-weight: 800; color: var(--gold);
    }

    .hero-stat .l {
        font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 2px;
    }

    .demo-pills {
        display: flex; flex-direction: column; gap: 10px;
    }

    .demo-pill {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px; padding: 12px 14px;
        display: flex; align-items: center; justify-content: space-between;
    }

    .demo-pill span { font-size: 13px; color: rgba(255,255,255,0.75); }

    .pill-tag {
        background: rgba(240,165,0,0.2); color: var(--gold);
        font-size: 10px; font-weight: 700; padding: 3px 8px;
        border-radius: 20px; text-transform: uppercase;
    }

    /* ── SECTIONS ── */
    .section { padding: 80px 5%; }
    .section-center { text-align: center; }

    .section-header { margin-bottom: 48px; }

    /* ── SKILLS ── */
    .skills-section { background: var(--light); }

    .skills-grid {
        max-width: 1160px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
    }

    .skill-category {
        background: white; border-radius: 16px;
        border: 1px solid var(--border); padding: 28px;
    }

    .skill-category-title {
        font-size: 13px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1.5px;
        color: var(--gold); margin-bottom: 20px;
        display: flex; align-items: center; gap: 8px;
    }

    .skill-item {
        margin-bottom: 16px;
    }

    .skill-item-top {
        display: flex; justify-content: space-between;
        font-size: 14px; font-weight: 500; color: var(--dark);
        margin-bottom: 6px;
    }

    .skill-item-top span:last-child { color: var(--gray); font-size: 12px; }

    .skill-bar {
        height: 6px; background: var(--border); border-radius: 10px;
        overflow: hidden;
    }

    .skill-bar-fill {
        height: 100%; border-radius: 10px;
        background: linear-gradient(90deg, var(--navy2), var(--gold));
        transition: width 1s ease;
    }

    /* ── FEATURED PROJECTS ── */
    .projects-grid {
        max-width: 1160px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .project-card {
        background: white; border-radius: 16px;
        border: 1px solid var(--border);
        overflow: hidden; transition: all 0.3s;
    }

    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(13,27,75,0.12);
    }

    .project-image {
        height: 200px; background: linear-gradient(135deg, var(--navy2), var(--red));
        display: flex; align-items: center; justify-content: center;
        font-size: 48px;
    }

    .project-image img {
        width: 100%; height: 100%; object-fit: cover;
    }

    .project-body { padding: 24px; }

    .project-tech {
        display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px;
    }

    .tech-tag {
        background: var(--light); color: var(--navy2);
        font-size: 11px; font-weight: 600;
        padding: 3px 10px; border-radius: 20px;
    }

    .project-title {
        font-size: 18px; font-weight: 700; color: var(--navy);
        margin-bottom: 8px;
    }

    .project-desc {
        font-size: 14px; color: var(--gray); line-height: 1.6;
        margin-bottom: 16px;
    }

    .project-links { display: flex; gap: 10px; }

    .project-link {
        font-size: 13px; font-weight: 600; color: var(--navy2);
        padding: 7px 14px; border-radius: 7px;
        border: 1.5px solid var(--border); transition: all 0.2s;
    }

    .project-link:hover { background: var(--navy2); color: white; border-color: var(--navy2); }

    /* ── DEMO SECTION ── */
    .demo-cards-grid {
        max-width: 1160px; margin: 0 auto;
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
    }

    .demo-card {
        background: white; border-radius: 20px;
        border: 1px solid var(--border); overflow: hidden;
        transition: all 0.3s;
    }

    .demo-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(13,27,75,0.12); }

    .demo-card-top {
        padding: 32px 28px; text-align: center;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
    }

    .demo-card-icon { font-size: 52px; margin-bottom: 12px; }

    .demo-card-top h3 {
        font-size: 18px; font-weight: 700; color: white; margin-bottom: 6px;
    }

    .demo-card-top p {
        font-size: 13px; color: rgba(255,255,255,0.6);
    }

    .demo-card-body { padding: 20px 24px 24px; }

    .demo-feature-list { list-style: none; margin-bottom: 20px; }

    .demo-feature-list li {
        font-size: 13px; color: var(--gray);
        padding: 5px 0; display: flex; align-items: center; gap: 8px;
    }

    .demo-feature-list li::before {
        content: '✓'; color: var(--green);
        font-weight: 700; font-size: 12px;
        width: 16px; flex-shrink: 0;
    }

    .demo-try-btn {
        display: block; width: 100%;
        background: var(--navy2); color: white;
        padding: 12px; border-radius: 10px;
        text-align: center; font-weight: 700; font-size: 14px;
        transition: all 0.2s;
    }

    .demo-try-btn:hover { background: var(--red); }

    /* ── CTA SECTION ── */
    .cta-section {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
        padding: 80px 5%; text-align: center;
    }

    .cta-section h2 {
        font-size: clamp(28px, 4vw, 48px); color: white;
        margin-bottom: 16px;
    }

    .cta-section p {
        font-size: 17px; color: rgba(255,255,255,0.7);
        max-width: 560px; margin: 0 auto 36px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .hero-grid { grid-template-columns: 1fr; }
        .hero-visual { display: none; }
        .skills-grid { grid-template-columns: 1fr; }
        .demo-cards-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 600px) {
        .hero { padding: 60px 5%; min-height: auto; }
        .projects-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-grid">
        <div class="hero-left">
            <div class="hero-eyebrow">
                <span>👋</span> Available for Projects
            </div>
            <h1 class="hero-title">
                I Build Systems,<br>Not Just <span>Websites</span>
            </h1>
            <p class="hero-subtitle">
                Hi, I'm <strong style="color:white;">Prince Chishanga</strong> — a full-stack web developer from Howick, KZN.
                I build fast, functional web systems for South African businesses that actually work and grow with you.
            </p>
            <div class="hero-actions">
                <a href="{{ route('demos') }}" class="hero-btn-primary">
                    🧪 Try Live Demos
                </a>
                <a href="{{ route('contact') }}" class="hero-btn-secondary">
                    💬 Get a Quote
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-card">
                <div class="hero-card-header">
                    <div class="avatar-lg">PC</div>
                    <div>
                        <h3>Prince Chishanga</h3>
                        <p>Web Developer · IT Student · SwiftSite Designs</p>
                    </div>
                </div>
                <div class="stat-row">
                    <div class="hero-stat">
                        <div class="n">{{ \App\Models\Project::count() ?: '5+' }}</div>
                        <div class="l">Projects</div>
                    </div>
                    <div class="hero-stat">
                        <div class="n">3</div>
                        <div class="l">Live Demos</div>
                    </div>
                    <div class="hero-stat">
                        <div class="n">KZN</div>
                        <div class="l">Based</div>
                    </div>
                </div>
                <div class="demo-pills">
                    <div class="demo-pill">
                        <span>📊 Finance Tracker</span>
                        <span class="pill-tag">Live</span>
                    </div>
                    <div class="demo-pill">
                        <span>💧 Water Drum Tracker</span>
                        <span class="pill-tag">Live</span>
                    </div>
                    <div class="demo-pill">
                        <span>📝 Family Link Blog</span>
                        <span class="pill-tag">Live</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SKILLS SECTION --}}
<section class="section skills-section">
    <div style="max-width:1160px;margin:0 auto;">
        <div class="section-header">
            <div class="section-label">What I Work With</div>
            <h2 class="section-title">Technical Skills</h2>
            <p class="section-subtitle">Built up through real projects, self-study, and hands-on development.</p>
        </div>

        @if($skills->isNotEmpty())
        <div class="skills-grid">
            @foreach($skills as $category => $categorySkills)
            <div class="skill-category">
                <div class="skill-category-title">
                    @if($category === 'frontend') 🎨 Frontend
                    @elseif($category === 'backend') ⚙️ Backend
                    @elseif($category === 'tools') 🔧 Tools & More
                    @else 💡 {{ ucfirst($category) }}
                    @endif
                </div>
                @foreach($categorySkills as $skill)
                <div class="skill-item">
                    <div class="skill-item-top">
                        <span>{{ $skill->name }}</span>
                        <span>{{ $skill->proficiency }}%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="width: {{ $skill->proficiency }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        @else
        {{-- Default skills if database is empty --}}
        <div class="skills-grid">
            <div class="skill-category">
                <div class="skill-category-title">🎨 Frontend</div>
                @foreach([['HTML/CSS', 90], ['JavaScript', 75], ['Tailwind CSS', 80], ['Blade Templates', 85]] as [$name, $pct])
                <div class="skill-item">
                    <div class="skill-item-top"><span>{{ $name }}</span><span>{{ $pct }}%</span></div>
                    <div class="skill-bar"><div class="skill-bar-fill" style="width:{{ $pct }}%"></div></div>
                </div>
                @endforeach
            </div>
            <div class="skill-category">
                <div class="skill-category-title">⚙️ Backend</div>
                @foreach([['Laravel', 85], ['PHP', 80], ['MySQL', 78], ['REST APIs', 70]] as [$name, $pct])
                <div class="skill-item">
                    <div class="skill-item-top"><span>{{ $name }}</span><span>{{ $pct }}%</span></div>
                    <div class="skill-bar"><div class="skill-bar-fill" style="width:{{ $pct }}%"></div></div>
                </div>
                @endforeach
            </div>
            <div class="skill-category">
                <div class="skill-category-title">🔧 Tools</div>
                @foreach([['Git & GitHub', 80], ['VS Code', 90], ['Azure', 65], ['Linux', 60]] as [$name, $pct])
                <div class="skill-item">
                    <div class="skill-item-top"><span>{{ $name }}</span><span>{{ $pct }}%</span></div>
                    <div class="skill-bar"><div class="skill-bar-fill" style="width:{{ $pct }}%"></div></div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- FEATURED PROJECTS --}}
<section class="section">
    <div style="max-width:1160px;margin:0 auto;">
        <div class="section-header" style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:16px;">
            <div>
                <div class="section-label">Portfolio</div>
                <h2 class="section-title" style="margin-bottom:0;">Featured Projects</h2>
            </div>
            <a href="{{ route('portfolio') }}" class="btn btn-outline">View All →</a>
        </div>

        @if($featuredProjects->isNotEmpty())
        <div class="projects-grid">
            @foreach($featuredProjects as $project)
            <div class="project-card">
                <div class="project-image">
                    @if($project->image_path)
                        <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}">
                    @else
                        🏗️
                    @endif
                </div>
                <div class="project-body">
                    <div class="project-tech">
                        @foreach(explode(',', $project->tech_stack) as $tech)
                        <span class="tech-tag">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    <div class="project-title">{{ $project->title }}</div>
                    <p class="project-desc">{{ $project->short_description }}</p>
                    <div class="project-links">
                        @if($project->live_url)
                        <a href="{{ $project->live_url }}" class="project-link" target="_blank">Live Site ↗</a>
                        @endif
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" class="project-link" target="_blank">GitHub ↗</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:48px;color:var(--gray);">
            <div style="font-size:48px;margin-bottom:12px;">🏗️</div>
            <p>Projects coming soon. <a href="{{ route('contact') }}" style="color:var(--navy2);font-weight:600;">Contact me</a> to discuss your project.</p>
        </div>
        @endif
    </div>
</section>

{{-- LIVE DEMOS TEASER --}}
<section class="section" style="background:var(--light);">
    <div style="max-width:1160px;margin:0 auto;">
        <div class="section-header section-center">
            <div class="section-label">Interactive Demos</div>
            <h2 class="section-title">See Real Systems Live</h2>
            <p class="section-subtitle" style="margin:0 auto;">Not just screenshots — try actual working applications I've built. Add data, see it update in real time.</p>
        </div>

        <div class="demo-cards-grid">
            <div class="demo-card">
                <div class="demo-card-top">
                    <div class="demo-card-icon">📊</div>
                    <h3>Student Finance Tracker</h3>
                    <p>Manage income & expenses</p>
                </div>
                <div class="demo-card-body">
                    <ul class="demo-feature-list">
                        <li>Track income sources (NSFAS, part-time)</li>
                        <li>Log expenses by category</li>
                        <li>Live balance calculation</li>
                        <li>Transaction history</li>
                    </ul>
                    <a href="{{ route('demo.finance.index') }}" class="demo-try-btn">Try Finance Tracker →</a>
                </div>
            </div>

            <div class="demo-card">
                <div class="demo-card-top">
                    <div class="demo-card-icon">💧</div>
                    <h3>Water Drum Tracker</h3>
                    <p>Customer & payment management</p>
                </div>
                <div class="demo-card-body">
                    <ul class="demo-feature-list">
                        <li>Add customers & drum orders</li>
                        <li>Track payments per customer</li>
                        <li>View outstanding balances</li>
                        <li>Mark payments complete</li>
                    </ul>
                    <a href="{{ route('demo.water.index') }}" class="demo-try-btn">Try Water Tracker →</a>
                </div>
            </div>

            <div class="demo-card">
                <div class="demo-card-top">
                    <div class="demo-card-icon">📝</div>
                    <h3>Family Link Blog</h3>
                    <p>Simple social blogging system</p>
                </div>
                <div class="demo-card-body">
                    <ul class="demo-feature-list">
                        <li>Create and publish posts</li>
                        <li>View community feed</li>
                        <li>Like and comment on posts</li>
                        <li>Simple, clean interface</li>
                    </ul>
                    <a href="{{ route('demo.blog.index') }}" class="demo-try-btn">Try Family Blog →</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="cta-section">
    <div class="section-label">Ready to Build?</div>
    <h2>Let's Create Your Business System</h2>
    <p>From simple websites to complex management systems — I build what your business actually needs, at a price that works for you.</p>
    <a href="{{ route('contact') }}" class="hero-btn-primary">
        💬 Start a Conversation →
    </a>
</section>

@endsection