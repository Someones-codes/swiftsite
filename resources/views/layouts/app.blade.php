
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Prince Chishanga') | Software Developer</title>
    <meta name="description" content="Prince Chishanga — Software Developer & BSc IT Student building full-stack web applications with Laravel, PHP, and MySQL.">
    <meta name="keywords" content="Prince Chishanga, software developer, Laravel developer, web developer South Africa">
    <meta property="og:title" content="Prince Chishanga - Software Developer">
    <meta property="og:description" content="Full-stack developer building practical solutions with Laravel and modern web technologies.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ====================================================
           BASE RESET — applied once, here, not in child views
           ==================================================== */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        img, svg {
            max-width: 100%;
            height: auto;
            display: block;
        }

        a { text-decoration: none; color: inherit; }

        /* ====================================================
           FLASH MESSAGES (used by admin + demo pages)
           ==================================================== */
        .flash {
            padding: 14px 5%;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1px solid transparent;
        }

        .flash.success { background: #ecfdf5; color: #065f46; border-color: #a7f3d0; }
        .flash.error   { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
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

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
