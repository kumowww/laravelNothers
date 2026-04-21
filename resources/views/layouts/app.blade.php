<!DOCTYPE html>
<html lang="{{ $locale ?? 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #ffffff;
            color: #222222;
            transition: background 0.3s, color 0.3s;
        }

        body[data-theme="dark"] {
            background: #1a1a1a !important;
            color: #eeeeee !important;
        }

        header {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #e0e0e0;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background 0.3s, border-color 0.3s;
        }

        body[data-theme="dark"] header {
            background: rgba(30, 30, 30, 0.95) !important;
            border-bottom-color: #444444 !important;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: #222222;
            font-weight: 500;
            transition: color 0.3s, border-color 0.3s;
            padding: 5px 0;
            border-bottom: 2px solid transparent;
        }

        body[data-theme="dark"] nav a {
            color: #dddddd !important;
        }

        nav a:hover {
            color: #000000;
            border-bottom-color: #000000;
        }

        body[data-theme="dark"] nav a:hover {
            color: #ffffff !important;
            border-bottom-color: #ffffff !important;
        }

        .top-right-controls {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .locale-switcher {
            display: flex;
            gap: 8px;
            background: #f0f0f0;
            border-radius: 6px;
            padding: 4px 8px;
            transition: background 0.3s;
        }

        body[data-theme="dark"] .locale-switcher {
            background: #333333 !important;
        }

        .locale-switcher a {
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: #555555;
            border-radius: 4px;
            transition: all 0.3s;
            cursor: pointer;
        }

        body[data-theme="dark"] .locale-switcher a {
            color: #bbbbbb !important;
        }

        .locale-switcher a.active {
            background: #000000;
            color: #ffffff;
        }

        body[data-theme="dark"] .locale-switcher a.active {
            background: #ffffff !important;
            color: #000000 !important;
        }

        .locale-switcher a:hover:not(.active) {
            background: rgba(0, 0, 0, 0.1);
        }

        body[data-theme="dark"] .locale-switcher a:hover:not(.active) {
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .theme-toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .theme-toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cccccc;
            border-radius: 30px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 6px;
        }

        .slider .icon {
            font-size: 18px;
            line-height: 1;
            transition: opacity 0.2s;
            pointer-events: none;
            user-select: none;
        }

        .slider .sun {
            opacity: 0;
        }

        .slider .moon {
            opacity: 1;
        }

        body[data-theme="dark"] .slider {
            background-color: #555555 !important;
        }

        body[data-theme="dark"] .slider .sun {
            opacity: 1 !important;
        }

        body[data-theme="dark"] .slider .moon {
            opacity: 0 !important;
        }

        .slider:before {
            content: "";
            position: absolute;
            height: 24px;
            width: 24px;
            left: 3px;
            bottom: 3px;
            background-color: #ffffff;
            border-radius: 50%;
            transition: transform 0.3s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }

        body[data-theme="dark"] .slider:before {
            transform: translateX(30px);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            width: 180px;
            background: #000000;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s, color 0.3s;
            text-align: center;
            box-sizing: border-box;
        }

        .btn:hover {
            background: #333333;
        }

        .btn-secondary {
            background: #666666 !important;
        }

        .btn-secondary:hover {
            background: #555555 !important;
        }

        body[data-theme="dark"] .btn {
            background: #ffffff !important;
            color: #000000 !important;
        }

        body[data-theme="dark"] .btn:hover {
            background: #dddddd !important;
        }

        body[data-theme="dark"] .btn-secondary {
            background: #555555 !important;
            color: #ffffff !important;
        }

        body[data-theme="dark"] .btn-secondary:hover {
            background: #444444 !important;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 32px;
            color: #222222;
            transition: color 0.3s;
        }

        body[data-theme="dark"] h1 {
            color: #eeeeee !important;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 24px;
            color: #222222;
            transition: color 0.3s;
        }

        body[data-theme="dark"] h2 {
            color: #eeeeee !important;
        }

        p {
            color: #555555;
            transition: color 0.3s;
        }

        body[data-theme="dark"] p {
            color: #bbbbbb !important;
        }

        main {
            margin-bottom: 60px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #888888;
            border-top: 1px solid #e0e0e0;
            margin-top: 60px;
            transition: color 0.3s, border-color 0.3s;
        }

        body[data-theme="dark"] footer {
            border-top-color: #444444 !important;
            color: #aaaaaa !important;
        }

        .creator-link {
            color: #000000;
            text-decoration: none;
            transition: color 0.3s;
        }

        .creator-link:hover {
            color: #333333;
            text-decoration: underline;
        }

        body[data-theme="dark"] .creator-link {
            color: #ffffff !important;
        }

        body[data-theme="dark"] .creator-link:hover {
            color: #cccccc !important;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <nav>
                <a href="{{ route('home', ['locale' => $locale]) }}">@lang('messages.home')</a>
                <a href="{{ route('posts.index', ['locale' => $locale]) }}">@lang('messages.posts')</a>
                <a href="{{ route('products.index', ['locale' => $locale]) }}">@lang('messages.products')</a>
            </nav>
            
            <div class="top-right-controls">
                <div class="locale-switcher">
                    <a href="/en" class="@if($locale === 'en') active @endif">EN</a>
                    <a href="/de" class="@if($locale === 'de') active @endif">DE</a>
                    <a href="/ru" class="@if($locale === 'ru') active @endif">RU</a>
                </div>
                <label class="theme-toggle-switch">
                    <input type="checkbox" id="theme-toggle-input">
                    <span class="slider">
                        <span class="icon sun">☀</span>
                        <span class="icon moon">☾</span>
                    </span>
                </label>
            </div>
        </div>
    </header>

    @if ($errors->any())
        <div class="container">
            <div class="alert alert-danger">
                <strong>@lang('messages.error'):</strong>
                <ul style="margin-top: 10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="container">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 Laravel Blog. @lang('messages.all_rights_reserved')</p>
        <p style="margin-top: 10px;">
            @lang('messages.created_by') <a href="https://github.com/kumowww" target="_blank" class="creator-link">github:kumowww</a>
        </p>
    </footer>

    <script type="module" src="{{ asset('build/assets/app.js') }}" defer></script>
    <script>
        (function() {
            function applyTheme(theme) {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
                var checkbox = document.getElementById('theme-toggle-input');
                if (checkbox) {
                    checkbox.checked = (theme === 'dark');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                var savedTheme = localStorage.getItem('theme') || 'light';
                applyTheme(savedTheme);

                var checkbox = document.getElementById('theme-toggle-input');
                if (checkbox) {
                    checkbox.addEventListener('change', function(e) {
                        var newTheme = e.target.checked ? 'dark' : 'light';
                        applyTheme(newTheme);
                    });
                }
            });
        })();
    </script>
</body>
</html>