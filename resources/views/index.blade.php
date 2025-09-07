<x-layout title="Daftar Tugas">
    @if (session('locked'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-yellow-500/20 border border-yellow-400/30">
            {{ session('locked') }}
        </div>
    @endif

    <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-6">
        <input name="q" value="{{ $q }}" placeholder="Cari tugas..."
            class="flex-1 bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400" />
        <select name="status"
            class="bg-white/20 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-400">
            <option value="all" {{ $status === 'all' ? 'selected' : '' }}>Semua</option>
            <option value="on going" {{ $status === 'on going' ? 'selected' : '' }}>🟡 On Going</option>
            <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
        </select>
        <button
            class="px-5 py-3 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-xl font-semibold hover:scale-[1.01] transition">
            Terapkan
        </button>
    </form>

    {{-- Form Tambah --}}
    <form action="{{ route('todos.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3 mb-6">
        @csrf
        <input type="text" name="title" placeholder="Tambah tugas baru..."
            class="flex-1 bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400"
            required>
        <button
            class="px-5 py-3 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-xl font-semibold hover:scale-[1.01] transition">
            Add
        </button>
    </form>

    {{-- List --}}
    <ul class="space-y-3">
        @forelse ($todos as $todo)
            <li
                class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl px-4 py-3 shadow-md">
                <div class="flex items-center gap-3">
                    <form action="{{ route('todos.update', $todo) }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="title" value="{{ $todo->title }}">
                        <select name="status" onchange="this.form.submit()"
                            class="rounded-lg px-3 py-1 bg-white/20 {{ $todo->status === 'selesai' ? 'opacity-60 cursor-not-allowed' : '' }}"
                            {{ $todo->status === 'selesai' ? 'disabled' : '' }}>
                            <option value="on going" {{ $todo->status == 'on going' ? 'selected' : '' }}>🟡 On Going</option>
                            <option value="selesai" {{ $todo->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                        </select>

                        <span
                            class="font-medium tracking-wide {{ $todo->status === 'selesai' ? 'line-through text-gray-400' : '' }}">
                            {{ $todo->title }}
                        </span>
                    </form>
                </div>

                <div class="flex gap-3 mt-2 sm:mt-0">
                    <button
                        onclick="openEditModal('{{ $todo->id }}', '{{ str_replace(['\'', '"'], ['\\\'', '&quot;'], $todo->title) }}', '{{ $todo->status }}')"
                        class="text-cyan-400 hover:text-cyan-500 transition {{ $todo->status === 'selesai' ? 'opacity-40 cursor-not-allowed pointer-events-none' : '' }}">
                        ✏️
                    </button>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST"
                        onsubmit="return confirm('Hapus tugas ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-500 transition">❌</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="text-white/70">Belum ada tugas.</li>
        @endforelse
    </ul>

    {{-- Modal Edit --}}
    <div id="editModal" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-50 p-4">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit To-Do</h2>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <input id="editTitle" name="title" type="text"
                    class="w-full mb-4 bg-white/20 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                    required>
                <input type="hidden" name="status" id="editStatusValue" value="on going">
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-500/30 rounded-lg hover:bg-gray-500/50 transition">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-lg font-semibold hover:scale-[1.01] transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, title, status) {
            if (status === 'selesai') return;
            document.getElementById('editForm').action = '/todos/' + id;
            document.getElementById('editTitle').value = title;
            document.getElementById('editStatusValue').value = 'on going';
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
    </script>
</x-layout>