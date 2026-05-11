@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<div class="page-header">
    <div>
        <h1>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
        <p>Here's what's happening with SwiftSite Designs today.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline btn-sm">🌐 View Public Site ↗</a>
</div>

{{-- STAT GRID --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon">🏗️</div>
        <div class="stat-label">Total Projects</div>
        <div class="stat-value">{{ \App\Models\Project::count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">⭐</div>
        <div class="stat-label">Featured</div>
        <div class="stat-value">{{ \App\Models\Project::where('is_featured', true)->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">💬</div>
        <div class="stat-label">Messages</div>
        <div class="stat-value">{{ \App\Models\Message::count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📬</div>
        <div class="stat-label">Unread</div>
        <div class="stat-value" style="color:var(--red);">{{ \App\Models\Message::where('is_read', false)->count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">⚡</div>
        <div class="stat-label">Skills Listed</div>
        <div class="stat-value">{{ \App\Models\Skill::count() }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📄</div>
        <div class="stat-label">CV Uploaded</div>
        <div class="stat-value">{{ \App\Models\CvFile::where('is_active', true)->exists() ? 'Yes' : 'No' }}</div>
    </div>
</div>

{{-- QUICK ACTIONS --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">

    {{-- RECENT MESSAGES --}}
    <div class="card">
        <div class="card-header">
            <h2>💬 Recent Messages</h2>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        <div class="card-body" style="padding:0;">
            @php $messages = \App\Models\Message::latest()->take(5)->get(); @endphp
            @forelse($messages as $msg)
            <a href="{{ route('admin.messages.show', $msg) }}" style="display:flex;align-items:center;gap:14px;padding:14px 20px;border-bottom:1px solid var(--border);transition:background 0.15s;text-decoration:none;" onmouseover="this.style.background='var(--light)'" onmouseout="this.style.background=''"  >
                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--navy2),var(--red));display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:14px;flex-shrink:0;">
                    {{ substr($msg->name, 0, 1) }}
                </div>
                <div style="flex:1;overflow:hidden;">
                    <div style="font-size:14px;font-weight:{{ $msg->is_read ? '400' : '700' }};color:var(--dark);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        {{ $msg->name }}
                        @if(!$msg->is_read) <span style="width:8px;height:8px;background:var(--red);border-radius:50%;display:inline-block;margin-left:4px;"></span> @endif
                    </div>
                    <div style="font-size:12px;color:var(--gray);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Str::limit($msg->message, 50) }}</div>
                </div>
                <div style="font-size:11px;color:var(--gray);white-space:nowrap;">{{ $msg->created_at->diffForHumans() }}</div>
            </a>
            @empty
            <div style="padding:32px;text-align:center;color:var(--gray);font-size:14px;">
                No messages yet. Share your portfolio link!
            </div>
            @endforelse
        </div>
    </div>

    {{-- QUICK LINKS --}}
    <div style="display:flex;flex-direction:column;gap:14px;">
        <div class="card">
            <div class="card-header"><h2>⚡ Quick Actions</h2></div>
            <div class="card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ New Project</a>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline">Manage Skills</a>
                <a href="{{ route('admin.cv.index') }}" class="btn btn-outline">Update CV</a>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-outline">View Leads</a>
            </div>
        </div>

        <div class="card" style="background:linear-gradient(135deg,var(--navy),var(--navy2));border:none;">
            <div class="card-body">
                <div style="font-size:13px;color:rgba(255,255,255,0.5);font-weight:600;text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">Live Demos</div>
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <a href="{{ route('demo.finance.index') }}" target="_blank" style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);color:white;padding:10px 14px;border-radius:8px;font-size:13px;font-weight:600;display:flex;justify-content:space-between;align-items:center;">
                        📊 Finance Tracker <span style="opacity:.5;">↗</span>
                    </a>
                    <a href="{{ route('demo.water.index') }}" target="_blank" style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);color:white;padding:10px 14px;border-radius:8px;font-size:13px;font-weight:600;display:flex;justify-content:space-between;align-items:center;">
                        💧 Water Tracker <span style="opacity:.5;">↗</span>
                    </a>
                    <a href="{{ route('demo.blog.index') }}" target="_blank" style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);color:white;padding:10px 14px;border-radius:8px;font-size:13px;font-weight:600;display:flex;justify-content:space-between;align-items:center;">
                        📝 Family Blog <span style="opacity:.5;">↗</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection