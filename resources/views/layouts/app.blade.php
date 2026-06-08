<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SwiftSite Designs') | Prince Chishanga</title>
    <meta name="description" content="@yield('meta_description', 'Full-stack web developer building fast, modern systems for South African businesses.')">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:   #0d1b4b;
            --navy2:  #1a237e;
            --gold:   #f0a500;
            --gold2:  #ffd54f;
            --red:    #c62828;
            --white:  #ffffff;
            --light:  #f5f7ff;
            --gray:   #6b7280;
            --dark:   #0f172a;
            --border: #e2e8f0;
            --radius: 12px;
            --shadow: 0 4px 24px rgba(13,27,75,0.10);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--dark);
            line-height: 1.65;
        }

        h1,h2,h3,h4,h5 {
            font-family: 'Sora', sans-serif;
            line-height: 1.25;
        }

        a { text-decoration: none; color: inherit; }

        img { max-width: 100%; height: auto; display: block; }

        /* ── NAVBAR ── */
        nav.main-nav {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 5%;
            display: flex; align-items: center; justify-content: space-between;
            height: 68px;
        }

        .nav-brand {
            display: flex; align-items: center; gap: 10px;
        }

        .nav-logo {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--navy2), var(--red));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-family: 'Sora', sans-serif;
            font-weight: 800; font-size: 16px;
        }

        .nav-brand-name {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 17px;
            color: var(--navy);
        }

        .nav-brand-name span { color: var(--gold); }

        .nav-links {
            display: flex; align-items: center; gap: 36px;
            list-style: none;
        }

        .nav-links a {
            font-size: 14px; font-weight: 500;
            color: var(--gray);
            transition: color 0.2s;
            position: relative;
        }

        .nav-links a:hover,
        .nav-links a.active { color: var(--navy2); }

        .nav-links a.active::after {
            content: '';
            position: absolute; bottom: -4px; left: 0; right: 0;
            height: 2px; background: var(--gold);
            border-radius: 2px;
        }

        .nav-cta {
            background: var(--navy2);
            color: white !important;
            padding: 9px 22px;
            border-radius: 8px;
            font-size: 13px !important;
            font-weight: 600 !important;
            transition: background 0.2s, transform 0.1s !important;
        }

        .nav-cta:hover {
            background: var(--red) !important;
            transform: translateY(-1px);
        }

        /* ── HAMBURGER (mobile) ── */
        .nav-toggle {
            display: none;
            flex-direction: column; gap: 5px; cursor: pointer;
            background: none; border: none; padding: 4px;
        }

        .nav-toggle span {
            width: 22px; height: 2px;
            background: var(--navy); border-radius: 2px;
            transition: 0.3s;
        }

        /* ── FLASH MESSAGES ── */
        .flash {
            padding: 14px 5%;
            font-size: 14px; font-weight: 500;
            border-bottom: 1px solid transparent;
        }

        .flash.success { background: #ecfdf5; color: #065f46; border-color: #a7f3d0; }
        .flash.error   { background: #fef2f2; color: #991b1b; border-color: #fecaca; }

        /* ── FOOTER ── */
        footer {
            background: var(--navy);
            color: rgba(255,255,255,0.7);
            padding: 48px 5% 24px;
            margin-top: 80px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 48px;
            padding-bottom: 36px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .footer-brand p {
            font-size: 14px; line-height: 1.7; margin-top: 12px;
            max-width: 280px;
        }

        .footer-brand-name {
            font-family: 'Sora', sans-serif;
            font-weight: 700; font-size: 18px;
            color: white;
        }

        .footer-brand-name span { color: var(--gold); }

        .footer-col h4 {
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 16px;
        }

        .footer-col ul { list-style: none; }

        .footer-col ul li { margin-bottom: 10px; }

        .footer-col ul li a {
            font-size: 14px; color: rgba(255,255,255,0.7);
            transition: color 0.2s;
        }

        .footer-col ul li a:hover { color: var(--gold); }

        .footer-bottom {
            display: flex; justify-content: space-between; align-items: center;
            padding-top: 24px;
            font-size: 13px;
        }

        .footer-bottom a { color: var(--gold); }

        /* ── UTILITIES ── */
        .container { max-width: 1160px; margin: 0 auto; padding: 0 5%; }

        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 28px; border-radius: 8px;
            font-weight: 600; font-size: 14px;
            border: none; cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-primary {
            background: var(--navy2); color: white;
        }

        .btn-primary:hover { background: var(--red); transform: translateY(-2px); }

        .btn-gold {
            background: var(--gold); color: var(--navy);
        }

        .btn-gold:hover { background: var(--gold2); transform: translateY(-2px); }

        .btn-outline {
            background: transparent; color: var(--navy2);
            border: 2px solid var(--navy2);
        }

        .btn-outline:hover { background: var(--navy2); color: white; }

        .section-label {
            font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 2px;
            color: var(--gold);
        }

        .section-title {
            font-size: clamp(28px, 4vw, 42px);
            color: var(--navy); margin-top: 8px; margin-bottom: 16px;
        }

        .section-subtitle {
            font-size: 16px; color: var(--gray);
            max-width: 560px; line-height: 1.7;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .nav-links { display: none; flex-direction: column; gap: 0;
                position: absolute; top: 68px; left: 0; right: 0;
                background: white; border-bottom: 1px solid var(--border);
                padding: 16px 5%;
            }
            .nav-links.open { display: flex; }
            .nav-toggle { display: flex; }
            .footer-grid { grid-template-columns: 1fr; gap: 32px; }
            .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
        }
    </style>

    @stack('styles')
</head>
<body>



    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="flash success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="flash error">✕ {{ session('error') }}</div>
    @endif

    {{-- PAGE CONTENT --}}
    <main>
        @include('components.navbar')
        @yield('content')
    </main>



    @stack('scripts')
</body>
</html>