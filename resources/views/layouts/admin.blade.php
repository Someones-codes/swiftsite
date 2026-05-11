<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | SwiftSite Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:  #0d1b4b;
            --navy2: #1a237e;
            --gold:  #f0a500;
            --red:   #c62828;
            --white: #ffffff;
            --light: #f1f4fd;
            --gray:  #6b7280;
            --dark:  #0f172a;
            --border:#e2e8f0;
            --sidebar-w: 240px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            color: var(--dark);
            display: flex; min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; }
        h1,h2,h3,h4 { font-family: 'Sora', sans-serif; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--navy);
            display: flex; flex-direction: column;
            position: fixed; left: 0; top: 0; bottom: 0;
            z-index: 50;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand-name {
            font-family: 'Sora', sans-serif;
            font-size: 17px; font-weight: 700;
            color: white;
        }

        .sidebar-brand-name span { color: var(--gold); }

        .sidebar-brand small {
            display: block;
            font-size: 11px; color: rgba(255,255,255,0.4);
            margin-top: 4px; letter-spacing: 1px; text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 16px 0; flex: 1;
        }

        .sidebar-section {
            padding: 12px 20px 4px;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.5px;
            color: rgba(255,255,255,0.3);
        }

        .sidebar-link {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 20px;
            font-size: 14px; font-weight: 500;
            color: rgba(255,255,255,0.65);
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.06);
            color: white;
        }

        .sidebar-link.active {
            background: rgba(240,165,0,0.12);
            color: var(--gold);
            border-left-color: var(--gold);
        }

        .sidebar-link .icon { font-size: 16px; width: 20px; text-align: center; }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-user {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 12px;
        }

        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--red));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; color: white;
            font-family: 'Sora', sans-serif;
            flex-shrink: 0;
        }

        .user-info { overflow: hidden; }

        .user-name {
            font-size: 13px; font-weight: 600; color: white;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px; color: rgba(255,255,255,0.4);
        }

        .btn-logout {
            display: flex; align-items: center; gap: 8px;
            width: 100%; padding: 9px 14px; border-radius: 8px;
            background: rgba(198,40,40,0.15); border: 1px solid rgba(198,40,40,0.3);
            color: #ff8a80; font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-logout:hover { background: rgba(198,40,40,0.3); }

        /* ── MAIN AREA ── */
        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1; display: flex; flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 40;
        }

        .topbar-title {
            font-family: 'Sora', sans-serif;
            font-size: 18px; font-weight: 700; color: var(--navy);
        }

        .topbar-right {
            display: flex; align-items: center; gap: 16px;
        }

        .badge-notification {
            background: var(--red); color: white;
            font-size: 11px; font-weight: 700;
            padding: 2px 8px; border-radius: 12px;
        }

        .topbar-btn {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            background: var(--light); border: none; cursor: pointer;
            color: var(--gray); transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .topbar-btn:hover { background: var(--border); color: var(--navy); }

        /* ── PAGE CONTENT ── */
        .admin-content {
            padding: 32px;
            flex: 1;
        }

        /* ── FLASH ── */
        .flash {
            padding: 12px 16px; border-radius: 8px; margin-bottom: 24px;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
        }

        .flash.success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .flash.error   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* ── CARDS ── */
        .card {
            background: white; border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }

        .card-header h2 {
            font-size: 16px; font-weight: 700; color: var(--navy);
        }

        .card-body { padding: 24px; }

        /* ── STAT CARDS ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white; border-radius: 12px;
            border: 1px solid var(--border);
            padding: 20px 24px;
        }

        .stat-card .stat-label {
            font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--gray);
        }

        .stat-card .stat-value {
            font-family: 'Sora', sans-serif;
            font-size: 32px; font-weight: 800;
            color: var(--navy); margin: 4px 0;
        }

        .stat-card .stat-icon {
            font-size: 28px; margin-bottom: 8px;
        }

        /* ── TABLES ── */
        .table-wrapper { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        thead tr { background: var(--light); }

        th {
            padding: 12px 16px; text-align: left;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--gray);
        }

        td {
            padding: 14px 16px;
            font-size: 14px; color: var(--dark);
            border-bottom: 1px solid var(--border);
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: var(--light); }

        /* ── FORMS ── */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--navy); margin-bottom: 6px;
        }

        .form-control {
            width: 100%; padding: 10px 14px; border-radius: 8px;
            border: 1.5px solid var(--border);
            font-size: 14px; font-family: 'DM Sans', sans-serif;
            color: var(--dark); transition: border 0.2s;
            background: white;
        }

        .form-control:focus {
            outline: none; border-color: var(--navy2);
            box-shadow: 0 0 0 3px rgba(26,35,126,0.08);
        }

        textarea.form-control { min-height: 120px; resize: vertical; }

        .form-hint { font-size: 12px; color: var(--gray); margin-top: 4px; }

        .form-error { font-size: 12px; color: var(--red); margin-top: 4px; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px; border-radius: 8px;
            font-size: 14px; font-weight: 600;
            border: none; cursor: pointer; transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-primary { background: var(--navy2); color: white; }
        .btn-primary:hover { background: #0d1b6e; }

        .btn-gold { background: var(--gold); color: var(--navy); }
        .btn-gold:hover { background: #d4920a; }

        .btn-danger { background: var(--red); color: white; }
        .btn-danger:hover { background: #b71c1c; }

        .btn-sm { padding: 6px 14px; font-size: 12px; }

        .btn-outline {
            background: transparent; border: 1.5px solid var(--border);
            color: var(--gray);
        }

        .btn-outline:hover { border-color: var(--navy2); color: var(--navy2); }

        /* ── BADGES ── */
        .badge {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 600;
        }

        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger  { background: #fee2e2; color: #991b1b; }
        .badge-info    { background: #dbeafe; color: #1e40af; }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 28px; gap: 16px; flex-wrap: wrap;
        }

        .page-header h1 { font-size: 24px; font-weight: 800; color: var(--navy); }
        .page-header p  { font-size: 14px; color: var(--gray); margin-top: 4px; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .admin-content { padding: 20px 16px; }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-name">Swift<span>Site</span></div>
            <small>Admin Panel</small>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon">📊</span> Dashboard
            </a>

            <div class="sidebar-section">Content</div>
            <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <span class="icon">🏗️</span> Projects
            </a>
            <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <span class="icon">⚡</span> Skills
            </a>
            <a href="{{ route('admin.cv.index') }}" class="sidebar-link {{ request()->routeIs('admin.cv.*') ? 'active' : '' }}">
                <span class="icon">📄</span> CV / Resume
            </a>

            <div class="sidebar-section">Leads</div>
            <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <span class="icon">💬</span> Messages
                @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
                @if($unread > 0)
                    <span style="margin-left:auto;background:var(--red);color:white;font-size:10px;padding:2px 7px;border-radius:20px;font-weight:700;">{{ $unread }}</span>
                @endif
            </a>

            <div class="sidebar-section">View Site</div>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <span class="icon">🌐</span> Public Site ↗
            </a>
            <a href="{{ route('demos') }}" target="_blank" class="sidebar-link">
                <span class="icon">🧪</span> Demos ↗
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <span>🚪</span> Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="admin-main">
        <header class="topbar">
            <span class="topbar-title">@yield('title', 'Dashboard')</span>
            <div class="topbar-right">
                <a href="{{ route('home') }}" target="_blank" class="topbar-btn">
                    🌐 View Site
                </a>
            </div>
        </header>

        <div class="admin-content">
            @if(session('success'))
                <div class="flash success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash error">✕ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>