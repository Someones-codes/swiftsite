<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Live Demo') | Prince Chishanga</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            color: var(--dark);
            min-height: 100vh;
        }
        h1, h2, h3, h4 { font-family: 'Sora', sans-serif; }
        a { text-decoration: none; }
    </style>

    @stack('styles')
</head>
<body>

    {{-- NAVBAR — always links back to the portfolio homepage --}}
    <nav class="demo-back-nav">
        <a href="{{ route('home') }}" class="demo-back-link">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span class="label-text">Back to Portfolio</span>
        </a>

        <div class="demo-app-title">
            @yield('demo-icon', '🧪')
            <span class="app-name-text">@yield('demo-name', 'Demo System')</span>
            <span class="demo-live-badge">Demo</span>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="demo-flash success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="demo-flash error">✕ {{ session('error') }}</div>
    @endif

    {{-- PAGE CONTENT --}}
    <div class="demo-page-wrap">
        @yield('content')
    </div>

    <script src="{{ asset('js/demo.js') }}"></script>
    @stack('scripts')
</body>
</html>