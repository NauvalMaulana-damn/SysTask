<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? 'SysTask - Futuristic To-Do' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-black text-white">
    <header class="px-4 sm:px-6 py-4 flex items-center justify-between">
        {{-- Branding SysTask --}}
        <a href="{{ route('todos.index') }}"
           class="flex items-center gap-2 text-2xl sm:text-3xl font-extrabold tracking-wider
                  text-cyan-400 drop-shadow-[0_0_10px_rgba(34,211,238,0.9)]
                  hover:text-cyan-300 hover:scale-105 transition transform duration-300">
            <span class="animate-pulse">⚡</span>
            <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
                SysTask
            </span>
        </a>

        {{-- Navigasi --}}
        <nav class="flex items-center gap-3">
            @auth
                <span class="hidden sm:inline text-white/80">Halo, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="px-3 py-2 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition">
                        Logout
                    </button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}"
                    class="px-3 py-2 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition">
                    Login
                </a>
            @endguest
        </nav>
    </header>

    <main class="px-4 sm:px-6 py-6">
        <div class="mx-auto w-full max-w-3xl">
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl shadow-2xl p-4 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </main>
</body>

</html>
