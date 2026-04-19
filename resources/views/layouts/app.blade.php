<!DOCTYPE html>
<html lang="{{ $locale ?? 'en' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #fff;
            color: #333;
            transition: background 0.3s, color 0.3s;
        }

        body[data-theme="dark"] {
            background: #1a1a1a;
            color: #f0f0f0;
        }

        header {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #e0e0e0;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        body[data-theme="dark"] header {
            background: rgba(30, 30, 30, 0.95);
            border-bottom-color: #333;
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
            color: inherit;
            font-weight: 500;
            transition: color 0.3s;
            padding: 5px 0;
            border-bottom: 2px solid transparent;
        }

        nav a:hover {
            color: #007bff;
            border-bottom-color: #007bff;
        }

        .top-right-controls {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .locale-switcher {
            display: flex;
            gap: 8px;
            background: #f5f5f5;
            border-radius: 6px;
            padding: 4px 8px;
        }

        body[data-theme="dark"] .locale-switcher {
            background: #333;
        }

        .locale-switcher a {
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            color: #666;
            border-radius: 4px;
            transition: all 0.3s;
        }

        body[data-theme="dark"] .locale-switcher a {
            color: #aaa;
        }

        .locale-switcher a.active {
            background: #007bff;
            color: white;
        }

        .locale-switcher a:hover:not(.active) {
            background: rgba(0, 123, 255, 0.1);
        }

        .theme-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .theme-btn:hover {
            background: #f0f0f0;
        }

        body[data-theme="dark"] .theme-btn:hover {
            background: #333;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .alert ul {
            list-style: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 32px;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }

        main {
            margin-bottom: 60px;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #999;
            border-top: 1px solid #e0e0e0;
            margin-top: 60px;
        }

        body[data-theme="dark"] footer {
            border-top-color: #333;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <nav>
                <a href="/{{ $locale }}">Home</a>
                <a href="/{{ $locale }}/posts">Posts</a>
                <a href="/{{ $locale }}/products">Products</a>
            </nav>
            
            <div class="top-right-controls">
                <div class="locale-switcher">
                    <a href="/en" class="@if($locale === 'en') active @endif">EN</a>
                    <a href="/de" class="@if($locale === 'de') active @endif">DE</a>
                    <a href="/ru" class="@if($locale === 'ru') active @endif">RU</a>
                </div>
                <button id="theme-toggle" class="theme-btn" title="Toggle theme">🌙</button>
            </div>
        </div>
    </header>

    @if ($errors->any())
        <div class="container">
            <div class="alert alert-danger">
                <div>
                    <strong>Ошибка!</strong>
                    <ul style="margin-top: 10px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="container">
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2026 Laravel Blog. All rights reserved.</p>
    </footer>

    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
        updateThemeButton();

        document.getElementById('theme-toggle').addEventListener('click', function() {
            const current = document.documentElement.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            updateThemeButton();
        });

        function updateThemeButton() {
            const current = document.documentElement.getAttribute('data-theme');
            const btn = document.getElementById('theme-toggle');
            btn.textContent = current === 'light' ? '🌙' : '☀️';
        }
    </script>
</body>
</html>