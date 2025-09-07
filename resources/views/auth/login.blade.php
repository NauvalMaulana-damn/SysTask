<x-layout title="Login">
    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf
        <h1 class="text-2xl font-bold mb-4">Masuk</h1>

        @error('email')
            <div class="text-red-300 text-sm">{{ $message }}</div>
        @enderror

        <input name="email" type="email" value="{{ old('email') }}" placeholder="Email"
            class="w-full bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400"
            required>

        <input name="password" type="password" placeholder="Password"
            class="w-full bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400"
            required>

        <label class="flex items-center gap-2 text-white/80">
            <input type="checkbox" name="remember" class="accent-cyan-400"> Ingat saya
        </label>

        <button
            class="w-full px-4 py-3 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-xl font-semibold hover:scale-[1.01] transition">Login</button>

        <p class="text-center text-white/70">Belum punya akun?
            <a class="underline" href="{{ route('register') }}">Register</a>
        </p>
    </form>
</x-layout>