<x-layout title="Register">
  <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
    @csrf
    <h1 class="text-2xl font-bold mb-4">Daftar</h1>

    @if ($errors->any())
      <ul class="text-red-300 text-sm list-disc pl-5">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    @endif

    <input name="name" value="{{ old('name') }}" placeholder="Nama"
      class="w-full bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>

    <input name="email" type="email" value="{{ old('email') }}" placeholder="Email"
      class="w-full bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>

    <input name="password" type="password" placeholder="Password"
      class="w-full bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>

    <input name="password_confirmation" type="password" placeholder="Konfirmasi Password"
      class="w-full bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400" required>

    <button class="w-full px-4 py-3 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-xl font-semibold hover:scale-[1.01] transition">Register</button>

    <p class="text-center text-white/70">Sudah punya akun?
      <a class="underline" href="{{ route('login') }}">Login</a>
    </p>
  </form>
</x-layout>
