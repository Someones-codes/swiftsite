@extends('layouts.app')
@section('title', 'Portfolio')

@push('styles')
<style>
    .portfolio-hero {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
        padding: 64px 5%;
    }

    .portfolio-hero h1 { font-size: clamp(30px,4vw,48px); color: white; margin-bottom: 12px; }
    .portfolio-hero p  { font-size: 17px; color: rgba(255,255,255,0.7); max-width: 520px; }

    .portfolio-main {
        padding: 56px 5%;
        max-width: 1160px; margin: 0 auto;
    }

    /* ── CV SECTION ── */
    .cv-section {
        background: white; border-radius: 20px;
        border: 1px solid var(--border);
        padding: 32px; margin-bottom: 56px;
        display: flex; align-items: center; justify-content: space-between;
        gap: 24px; flex-wrap: wrap;
        box-shadow: 0 4px 24px rgba(13,27,75,0.06);
    }

    .cv-left { display: flex; align-items: center; gap: 20px; }

    .cv-icon {
        width: 64px; height: 64px; border-radius: 14px;
        background: linear-gradient(135deg, var(--navy2), var(--red));
        display: flex; align-items: center; justify-content: center;
        font-size: 28px; flex-shrink: 0;
    }

    .cv-info h3 { font-size: 18px; font-weight: 800; color: var(--navy); margin-bottom: 4px; }
    .cv-info p  { font-size: 14px; color: var(--gray); }

    .cv-actions { display: flex; gap: 12px; }

    .cv-btn {
        padding: 11px 22px; border-radius: 10px;
        font-size: 14px; font-weight: 600;
        display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.2s;
    }

    .cv-btn-download {
        background: var(--navy2); color: white;
    }

    .cv-btn-download:hover { background: var(--red); }

    .cv-btn-outline {
        border: 1.5px solid var(--border); color: var(--gray); background: transparent;
    }

    .cv-btn-outline:hover { border-color: var(--navy2); color: var(--navy2); }

    /* ── FILTER TABS ── */
    .filter-bar {
        display: flex; gap: 8px; margin-bottom: 32px; flex-wrap: wrap;
    }

    .filter-btn {
        padding: 8px 20px; border-radius: 30px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        border: 1.5px solid var(--border); background: white;
        color: var(--gray); transition: all 0.2s;
    }

    .filter-btn:hover, .filter-btn.active {
        background: var(--navy2); color: white; border-color: var(--navy2);
    }

    /* ── PROJECT GRID ── */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .project-card {
        background: white; border-radius: 16px;
        border: 1px solid var(--border); overflow: hidden;
        transition: all 0.3s;
    }

    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(13,27,75,0.12);
    }

    .project-image {
        height: 200px;
        background: linear-gradient(135deg, var(--navy2) 0%, #c62828 100%);
        display: flex; align-items: center; justify-content: center;
        font-size: 52px; position: relative; overflow: hidden;
    }

    .project-image img { width:100%; height:100%; object-fit:cover; }

    .project-featured-badge {
        position: absolute; top: 12px; right: 12px;
        background: var(--gold); color: var(--navy);
        font-size: 10px; font-weight: 800;
        padding: 4px 10px; border-radius: 20px;
        text-transform: uppercase; letter-spacing: 1px;
    }

    .project-body { padding: 24px; }

    .project-tech {
        display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 10px;
    }

    .tech-tag {
        background: var(--light); color: var(--navy2);
        font-size: 11px; font-weight: 600;
        padding: 3px 10px; border-radius: 20px;
    }

    .project-title { font-size: 18px; font-weight: 700; color: var(--navy); margin-bottom: 8px; }
    .project-desc  { font-size: 14px; color: var(--gray); line-height: 1.6; margin-bottom: 16px; }

    .project-links { display: flex; gap: 10px; }

    .project-link {
        font-size: 13px; font-weight: 600; color: var(--navy2);
        padding: 7px 14px; border-radius: 7px;
        border: 1.5px solid var(--border); transition: all 0.2s;
    }

    .project-link:hover { background: var(--navy2); color: white; border-color: var(--navy2); }

    .empty-projects {
        grid-column: 1 / -1;
        text-align: center; padding: 64px 20px; color: var(--gray);
    }

    .empty-projects .icon { font-size: 56px; margin-bottom: 16px; }
    .empty-projects p { font-size: 15px; margin-bottom: 20px; }

    @media (max-width: 700px) {
        .cv-section { flex-direction: column; }
        .cv-left { flex-direction: column; text-align: center; }
        .projects-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="portfolio-hero">
    <div class="section-label">My Work</div>
    <h1>Portfolio & Resume</h1>
    <p>Projects I've built, systems I've shipped, and the tools I used to build them.</p>
</div>

<div class="portfolio-main">

    {{-- CV / RESUME SECTION --}}
    <div class="cv-section">
        <div class="cv-left">
            <div class="cv-icon">📄</div>
            <div class="cv-info">
                <h3>Curriculum Vitae — Prince Chishanga</h3>
                <p>Web Developer / IT Student · SwiftSite Designs · Last updated {{ date('M Y') }}</p>
            </div>
        </div>
        <div class="cv-actions">
            @if($activeCv)
                <a href="{{ route('cv.download') }}" class="cv-btn cv-btn-download">
                    ⬇ Download CV
                </a>
            @else
                <span style="font-size:14px;color:var(--gray);padding:11px 0;">CV not yet uploaded</span>
            @endif
        </div>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <button class="filter-btn active" onclick="filterProjects('all', this)">All Projects</button>
        <button class="filter-btn" onclick="filterProjects('featured', this)">Featured</button>
        <button class="filter-btn" onclick="filterProjects('laravel', this)">Laravel</button>
        <button class="filter-btn" onclick="filterProjects('php', this)">PHP</button>
    </div>

    {{-- PROJECTS GRID --}}
    <div class="projects-grid" id="projectsGrid">
        @forelse($projects as $project)
        <div class="project-card" data-featured="{{ $project->is_featured ? 'true' : 'false' }}" data-tech="{{ strtolower($project->tech_stack) }}">
            <div class="project-image">
                @if($project->image_path)
                    <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}">
                @else
                    🏗️
                @endif
                @if($project->is_featured)
                <div class="project-featured-badge">⭐ Featured</div>
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
        @empty
        <div class="empty-projects">
            <div class="icon">🏗️</div>
            <p>Projects are being added. Check back soon!</p>
            <a href="{{ route('contact') }}" class="cv-btn cv-btn-download">Discuss Your Project →</a>
        </div>
        @endforelse
    </div>

</div>

@endsection

@push('scripts')
<script>
function filterProjects(type, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.querySelectorAll('.project-card').forEach(card => {
        if (type === 'all') {
            card.style.display = '';
        } else if (type === 'featured') {
            card.style.display = card.dataset.featured === 'true' ? '' : 'none';
        } else {
            card.style.display = card.dataset.tech.includes(type) ? '' : 'none';
        }
    });
}
</script>
@endpush