<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Task Manager' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-950 text-slate-100 antialiased">
    <div class="min-h-screen">
        <header class="border-b border-slate-800 bg-slate-950/90">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold">
                    Task Manager
                </a>

                <nav class="flex items-center gap-6 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white">
                        Dashboard
                    </a>

                    <a href="{{ route('tasks.index') }}" class="text-slate-300 hover:text-white">
                        Tasks
                    </a>

                    <a href="{{ route('profile') }}" class="text-slate-300 hover:text-white">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300">
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>