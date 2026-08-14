<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Checkin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: {
                            DEFAULT: '#10121A',
                            900: '#0B0C12',
                            800: '#14161F'
                        },
                        surface: '#1A1D29',
                        surface2: '#20232F',
                        line: '#2C2F3D',
                        paper: '#F5F1E8',
                        paper2: '#EDE7D8',
                        brass: {
                            DEFAULT: '#C9974A',
                            bright: '#E0B36E'
                        },
                        teal: '#2DD4BF',
                        amber: '#F5A623',
                        coral: '#EF6461',
                        ink2: '#9599AB',
                    },
                    fontFamily: {
                        display: ['Fraunces', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                }
            }
        }
    </script>

    <script src="https://unpkg.com/lucide@0.468.0/dist/umd/lucide.js"></script>

    <style>
        body {
            background-color: #10121A;
        }

        .perforated {
            background-image: radial-gradient(circle at center, #10121A 2.5px, transparent 2.6px);
            background-size: 16px 16px;
            background-position: center;
        }

        .perforated-h {
            height: 1px;
            background-image: repeating-linear-gradient(to right, #2C2F3D 0, #2C2F3D 6px, transparent 6px, transparent 12px);
        }

        .notch {
            width: 24px;
            height: 24px;
            border-radius: 9999px;
            background: #10121A;
        }

        .grain {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 3px 3px;
        }
    </style>
</head>

<body class="bg-ink text-paper font-sans antialiased min-h-screen">
    <nav class="border-b border-line/60 sticky top-0 z-30 bg-ink/90 backdrop-blur">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <span
                    class="w-8 h-8 rounded-lg bg-brass/15 border border-brass/30 flex items-center justify-center text-brass group-hover:bg-brass/25 transition">
                    <i data-lucide="scan-line" class="w-4 h-4"></i>
                </span>
                <span class="font-display text-lg tracking-tight">
                    Laravel <span class="text-brass">Checkin</span>
                </span>
            </a>
            <div class="flex items-center gap-1 text-sm">
                <a href="{{ route('home') }}"
                    class="px-3 py-1.5 rounded-md text-ink2 hover:text-paper hover:bg-surface transition">
                    Overview
                </a>
                <a href="{{ route('events.index') }}"
                    class="px-3 py-1.5 rounded-md text-ink2 hover:text-paper hover:bg-surface transition">
                    Events
                </a>
                <a href="{{ route('checkin.desk') }}"
                    class="px-3 py-1.5 rounded-md text-ink2 hover:text-paper hover:bg-surface transition">
                    Check-in Desk
                </a>
                <a href="https://github.com/Mustafa21102005/laravel-checkin" target="_blank"
                    class="ml-2 px-3 py-1.5 rounded-md bg-surface border border-line hover:border-brass/50 transition flex items-center gap-1.5">
                    <i data-lucide="github" class="w-3.5 h-3.5"></i> GitHub
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-10">
        @if (session('status'))
            <div
                class="mb-6 rounded-lg bg-teal/10 border border-teal/30 text-teal px-4 py-3 text-sm flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0"></i> {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer
        class="max-w-5xl mx-auto px-6 py-10 mt-10 border-t border-line/60 text-xs text-ink2 flex items-center justify-between">
        <span>Demo app for <code class="font-mono text-brass">mustafa-azmi/laravel-checkin</code></span>
        <a href="https://packagist.org/packages/mustafa-azmi/laravel-checkin" target="_blank"
            class="hover:text-paper transition">
            Packagist →
        </a>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
