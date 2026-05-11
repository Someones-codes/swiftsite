<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Live Demo') | SwiftSite Designs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:   #0d1b4b;
            --navy2:  #1a237e;
            --gold:   #f0a500;
            --red:    #c62828;
            --white:  #ffffff;
            --light:  #f5f7ff;
            --gray:   #6b7280;
            --dark:   #0f172a;
            --border: #e2e8f0;
            --green:  #059669;
            --radius: 12px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            color: var(--dark);
            min-height: 100vh;
            padding-bottom: 120px; /* space for floating CTA */
        }

        a { text-decoration: none; color: inherit; }
        h1,h2,h3,h4 { font-family: 'Sora', sans-serif; }
        input, textarea, select, button { font-family: 'DM Sans', sans-serif; }

        /* ── DEMO BANNER ── */
        .demo-banner {
            background: var(--navy);
            color: rgba(255,255,255,0.85);
            padding: 10px 20px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 8px;
            font-size: 13px;
        }

        .demo-banner strong { color: var(--gold); }

        .demo-banner-links {
            display: flex; gap: 16px; align-items: center;
        }

        .demo-banner-links a {
            color: rgba(255,255,255,0.7);
            font-size: 13px; transition: color 0.2s;
        }

        .demo-banner-links a:hover { color: var(--gold); }

        /* ── DEMO TOPBAR ── */
        .demo-topbar {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 0 5%;
            height: 60px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }

        .demo-app-name {
            font-family: 'Sora', sans-serif;
            font-size: 17px; font-weight: 700; color: var(--navy);
            display: flex; align-items: center; gap: 10px;
        }

        .demo-badge {
            background: var(--navy2); color: white;
            font-size: 10px; font-weight: 700;
            padding: 3px 9px; border-radius: 20px;
            text-transform: uppercase; letter-spacing: 1px;
        }

        .demo-nav-links {
            display: flex; gap: 8px; list-style: none;
        }

        .demo-nav-links a {
            padding: 7px 16px; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            color: var(--gray); transition: all 0.2s;
        }

        .demo-nav-links a:hover, .demo-nav-links a.active {
            background: var(--light); color: var(--navy2);
        }

        /* ── FLASH MESSAGES ── */
        .flash {
            padding: 12px 5%;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
        }

        .flash.success { background: #ecfdf5; color: #065f46; border-bottom: 1px solid #a7f3d0; }
        .flash.error   { background: #fef2f2; color: #991b1b; border-bottom: 1px solid #fecaca; }

        /* ── MAIN CONTENT ── */
        .demo-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 5%;
        }

        /* ── DEMO PAGE HEADER ── */
        .demo-page-header {
            margin-bottom: 28px;
        }

        .demo-page-header h1 {
            font-size: 26px; font-weight: 800; color: var(--navy);
            margin-bottom: 6px;
        }

        .demo-page-header p { font-size: 15px; color: var(--gray); }

        /* ── CARDS ── */
        .card {
            background: white; border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: 0 1px 6px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }

        .card-header h2 {
            font-size: 15px; font-weight: 700; color: var(--navy);
        }

        .card-body { padding: 20px; }

        /* ── GRID ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }

        /* ── STAT CARDS ── */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px; margin-bottom: 28px;
        }

        .stat-card {
            background: white; border-radius: var(--radius);
            border: 1px solid var(--border);
            padding: 20px;
        }

        .stat-card .label {
            font-size: 12px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 1px; color: var(--gray);
        }

        .stat-card .value {
            font-family: 'Sora', sans-serif;
            font-size: 28px; font-weight: 800;
            margin-top: 4px;
        }

        .stat-card.income .value  { color: var(--green); }
        .stat-card.expense .value { color: var(--red); }
        .stat-card.balance .value { color: var(--navy2); }

        /* ── FORMS ── */
        .form-group { margin-bottom: 14px; }

        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--navy); margin-bottom: 5px;
        }

        .form-control {
            width: 100%; padding: 10px 13px;
            border: 1.5px solid var(--border); border-radius: 8px;
            font-size: 14px; color: var(--dark);
            transition: border-color 0.2s; background: white;
        }

        .form-control:focus {
            outline: none; border-color: var(--navy2);
            box-shadow: 0 0 0 3px rgba(26,35,126,0.08);
        }

        textarea.form-control { resize: vertical; min-height: 80px; }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 8px;
            font-size: 14px; font-weight: 600;
            border: none; cursor: pointer; transition: all 0.2s;
        }

        .btn-primary { background: var(--navy2); color: white; }
        .btn-primary:hover { background: #0d1b6e; }

        .btn-success { background: #059669; color: white; }
        .btn-success:hover { background: #047857; }

        .btn-danger { background: var(--red); color: white; }
        .btn-danger:hover { background: #b71c1c; }

        .btn-sm { padding: 6px 13px; font-size: 12px; }
        .btn-full { width: 100%; justify-content: center; }

        /* ── TABLE ── */
        .table-wrapper { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        th {
            padding: 11px 14px; text-align: left;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--gray); background: var(--light);
        }

        td {
            padding: 12px 14px; font-size: 14px;
            border-bottom: 1px solid var(--border);
        }

        tr:last-child td { border-bottom: none; }

        .amount-positive { color: var(--green); font-weight: 600; }
        .amount-negative { color: var(--red); font-weight: 600; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center; padding: 48px 20px;
            color: var(--gray);
        }

        .empty-state .icon { font-size: 48px; margin-bottom: 12px; }
        .empty-state p { font-size: 15px; }

        /* ── BADGE ── */
        .badge {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 600;
        }

        .badge-pending  { background: #fef3c7; color: #92400e; }
        .badge-partial  { background: #dbeafe; color: #1e40af; }
        .badge-complete { background: #d1fae5; color: #065f46; }

        /* ── FLOATING CTA ── */
        .floating-cta {
            position: fixed;
            bottom: 24px; right: 24px;
            z-index: 9999;
            max-width: 280px;
            animation: floatUp 0.6s ease 0.5s both, bobble 3s ease-in-out 1.2s infinite;
        }

        .floating-cta-inner {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 60%, var(--red) 100%);
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 8px 32px rgba(13,27,75,0.35),
                        0 2px 8px rgba(0,0,0,0.15);
        }

        .cta-dismiss {
            position: absolute; top: -8px; right: -8px;
            width: 24px; height: 24px; border-radius: 50%;
            background: white; border: none; cursor: pointer;
            font-size: 12px; color: var(--gray);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            transition: all 0.2s;
        }

        .cta-dismiss:hover { background: var(--red); color: white; }

        .cta-label {
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1.5px;
            color: var(--gold); margin-bottom: 6px;
        }

        .cta-headline {
            font-family: 'Sora', sans-serif;
            font-size: 14px; font-weight: 700; color: white;
            line-height: 1.4; margin-bottom: 14px;
        }

        .cta-btn {
            display: block; width: 100%;
            background: var(--gold); color: var(--navy);
            padding: 10px 16px; border-radius: 10px;
            text-align: center; font-weight: 700; font-size: 13px;
            transition: all 0.2s;
        }

        .cta-btn:hover {
            background: #ffd54f; transform: scale(1.02);
        }

        @keyframes floatUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes bobble {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }

        /* ── DEMO RESET NOTICE ── */
        .reset-notice {
            background: rgba(26,35,126,0.06); border: 1px solid rgba(26,35,126,0.12);
            border-radius: 8px; padding: 10px 14px;
            font-size: 12px; color: var(--gray);
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 20px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .grid-2, .grid-3 { grid-template-columns: 1fr; }
            .floating-cta { bottom: 16px; right: 16px; max-width: 240px; }
            .demo-topbar { padding: 0 16px; }
            .demo-content { padding: 20px 16px; }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- DEMO ALERT BANNER --}}
    <div class="demo-banner">
        <span>🔬 <strong>DEMO MODE</strong> — All data resets every 30 minutes. This is a demonstration system.</span>
        <div class="demo-banner-links">
            <a href="{{ route('demos') }}">← All Demos</a>
            <a href="{{ route('home') }}">Portfolio</a>
        </div>
    </div>

    {{-- DEMO APP TOPBAR --}}
    <div class="demo-topbar">
        <div class="demo-app-name">
            @yield('demo-icon', '🧪') @yield('demo-name', 'Demo System')
            <span class="demo-badge">Demo</span>
        </div>
        <ul class="demo-nav-links">
            @yield('demo-nav')
        </ul>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="flash success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash error">✕ {{ session('error') }}</div>
    @endif

    {{-- PAGE CONTENT --}}
    <div class="demo-content">
        @yield('content')
    </div>

    {{-- FLOATING CTA — appears on ALL demo pages --}}
    <div class="floating-cta" id="floatingCta">
        <div class="floating-cta-inner" style="position:relative;">
            <button class="cta-dismiss" onclick="document.getElementById('floatingCta').style.display='none'" title="Dismiss">✕</button>
            <div class="cta-label">💡 Like what you see?</div>
            <div class="cta-headline">Need a system like this for your business?</div>
            <a href="{{ route('contact') }}?ref=demo-{{ request()->segment(2) }}" class="cta-btn">
                Get a Website Like This →
            </a>
        </div>
    </div>

    @stack('scripts')
</body>
</html>