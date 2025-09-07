<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SysTask - Futuristic To-Do</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px #22d3ee, 0 0 10px #22d3ee, 0 0 15px #22d3ee' },
                            '100%': { boxShadow: '0 0 10px #22d3ee, 0 0 20px #22d3ee, 0 0 30px #22d3ee' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0f172a 100%);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(34, 211, 238, 0.1) 0%, transparent 20%),
                radial-gradient(circle at 90% 70%, rgba(59, 130, 246, 0.1) 0%, transparent 20%);
            z-index: -1;
        }
        
        .cyber-border {
            position: relative;
            overflow: hidden;
        }
        
        .cyber-border::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 1px solid rgba(34, 211, 238, 0.3);
            border-radius: 1.5rem;
            pointer-events: none;
            z-index: 1;
        }
        
        .task-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .task-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(34, 211, 238, 0.1), transparent);
            transition: left 0.7s ease;
        }
        
        .task-item:hover::before {
            left: 100%;
        }
        
        .glow-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .glow-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s ease;
        }
        
        .glow-btn:hover::before {
            left: 100%;
        }
        
        .cyber-select {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2322d3ee'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") no-repeat right 0.75rem center;
            background-size: 16px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 2.5rem;
        }
        
        .custom-select {
            position: relative;
        }
        
        .custom-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 2.5rem;
        }
        
        .custom-select::after {
            content: "";
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23ffffff'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            pointer-events: none;
        }
        
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            background: rgba(34, 211, 238, 0.3);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .shimmer-text {
            background: linear-gradient(90deg, #22d3ee, #60a5fa, #22d3ee);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s infinite linear;
        }
        
        .empty-state {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s ease forwards;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .bg-grid-pattern {
            background-image: 
                linear-gradient(rgba(34, 211, 238, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(34, 211, 238, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        /* Custom dropdown styling */
        .status-dropdown {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            color: white;
            backdrop-filter: blur(10px);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            min-width: 140px;
        }
        
        .status-dropdown:focus {
            outline: none;
            border-color: rgba(34, 211, 238, 0.5);
            box-shadow: 0 0 0 2px rgba(34, 211, 238, 0.2);
        }
        
        .status-dropdown:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .status-dropdown option {
            background-color: rgba(30, 41, 59, 0.95);
            color: white;
            padding: 0.5rem;
        }
    </style>
</head>
<body class="font-sans text-white">
    <!-- Particle Background -->
    <div class="particles" id="particles"></div>
    
    <x-layout title="Daftar Tugas">
        @if (session('locked'))
            <div class="mb-6 px-4 py-3 rounded-xl bg-yellow-500/20 border border-yellow-400/30 backdrop-blur-md animate-pulse">
                {{ session('locked') }}
            </div>
        @endif

        <div class="cyber-border bg-white/5 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl p-6 mb-8 relative overflow-hidden">
            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            
            <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-0">
                <input name="q" value="{{ $q }}" placeholder="Cari tugas..."
                    class="flex-1 bg-white/10 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400 border border-white/20 backdrop-blur-sm transition-all duration-300 focus:border-cyan-400/50" />
                
                <div class="custom-select flex-1">
                    <select name="status" class="w-full status-dropdown py-3 px-4">
                        <option value="all" {{ $status === 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="on going" {{ $status === 'on going' ? 'selected' : '' }}>🟡 On Going</option>
                        <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                    </select>
                </div>
                
                <button
                    class="glow-btn px-5 py-3 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-xl font-semibold hover:scale-[1.02] transition-all duration-300 hover:shadow-[0_0_15px_rgba(34,211,238,0.5)]">
                    Terapkan
                </button>
            </form>
        </div>

        <div class="cyber-border bg-white/5 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl p-6 mb-8 relative overflow-hidden">
            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            
            {{-- Form Tambah --}}
            <form action="{{ route('todos.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3 mb-0">
                @csrf
                <input type="text" name="title" placeholder="Tambah tugas baru..."
                    class="flex-1 bg-white/10 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400 border border-white/20 backdrop-blur-sm transition-all duration-300 focus:border-cyan-400/50"
                    required>
                <button
                    class="glow-btn px-5 py-3 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-xl font-semibold hover:scale-[1.02] transition-all duration-300 hover:shadow-[0_0_15px_rgba(34,211,238,0.5)]">
                    Add
                </button>
            </form>
        </div>

        {{-- List --}}
        <div class="cyber-border bg-white/5 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl p-6 relative overflow-hidden">
            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
            
            <ul class="space-y-4">
                @forelse ($todos as $todo)
                    <li class="task-item flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl px-5 py-4 shadow-lg hover:shadow-cyan-500/20 hover:border-cyan-400/30 hover:scale-[1.01] transition-all duration-300">
                        <div class="flex items-center gap-3 mb-3 sm:mb-0 flex-1">
                            <form action="{{ route('todos.update', $todo) }}" method="POST" class="flex items-center gap-3 flex-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="title" value="{{ $todo->title }}">
                                
                                <div class="custom-select">
                                    <select name="status" onchange="this.form.submit()"
                                        class="status-dropdown {{ $todo->status === 'selesai' ? 'opacity-60 cursor-not-allowed' : '' }}"
                                        {{ $todo->status === 'selesai' ? 'disabled' : '' }}>
                                        <option value="on going" {{ $todo->status == 'on going' ? 'selected' : '' }}>🟡 On Going</option>
                                        <option value="selesai" {{ $todo->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                    </select>
                                </div>

                                <span
                                    class="font-medium tracking-wide flex-1 {{ $todo->status === 'selesai' ? 'line-through text-gray-400' : '' }}">
                                    {{ $todo->title }}
                                </span>
                            </form>
                        </div>

                        <div class="flex gap-3 self-end sm:self-auto">
                            <button
                                onclick="openEditModal('{{ $todo->id }}', '{{ str_replace(['\'', '"'], ['\\\'', '&quot;'], $todo->title) }}', '{{ $todo->status }}')"
                                class="p-2 rounded-lg bg-cyan-500/10 hover:bg-cyan-500/20 transition-all duration-300 hover:scale-110 {{ $todo->status === 'selesai' ? 'opacity-40 cursor-not-allowed pointer-events-none' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal('{{ $todo->id }}', '{{ str_replace(['\'', '"'], ['\\\'', '&quot;'], $todo->title) }}')"
                                class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 transition-all duration-300 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </li>
                @empty
                    <li class="empty-state text-center py-12 text-white/70">
                        <div class="mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-cyan-400/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-300 mb-2">Belum ada tugas</h3>
                        <p class="text-gray-400 max-w-md mx-auto">Tambahkan tugas pertama Anda dengan mengisi form di atas!</p>
                    </li>
                @endforelse
            </ul>
        </div>

        {{-- Modal Edit --}}
        <div id="editModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-md items-center justify-center z-50 p-4 transition-opacity duration-300">
            <div class="cyber-border bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl p-6 w-full max-w-md transform transition-transform duration-300 scale-95 opacity-0"
                id="editModalContent">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Tugas
                </h2>
                <form id="editForm" method="POST">
                    @csrf @method('PUT')
                    <input id="editTitle" name="title" type="text"
                        class="w-full mb-4 bg-white/10 rounded-xl px-4 py-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-400 border border-white/20 backdrop-blur-sm"
                        required>
                    <input type="hidden" name="status" id="editStatusValue" value="on going">
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-500/30 rounded-lg hover:bg-gray-500/50 transition-all duration-300">Batal</button>
                        <button type="submit"
                            class="glow-btn px-4 py-2 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-lg font-semibold hover:scale-[1.02] transition-all duration-300">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Hapus --}}
        <div id="deleteModal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-md items-center justify-center z-50 p-4 transition-opacity duration-300">
            <div class="cyber-border bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl p-6 w-full max-w-md transform transition-transform duration-300 scale-95 opacity-0"
                id="deleteModalContent">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2 text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Hapus Tugas
                </h2>
                <p class="mb-6">Apakah Anda yakin ingin menghapus tugas "<span id="deleteTaskTitle" class="font-semibold"></span>"? Tindakan ini tidak dapat dibatalkan.</p>
                <form id="deleteForm" method="POST">
                    @csrf 
                    @method('DELETE')
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeDeleteModal()"
                            class="px-4 py-2 bg-gray-500/30 rounded-lg hover:bg-gray-500/50 transition-all duration-300">Batal</button>
                        <button type="submit"
                            class="glow-btn px-4 py-2 bg-gradient-to-r from-red-400 to-red-600 rounded-lg font-semibold hover:scale-[1.02] transition-all duration-300">Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Create background particles
            document.addEventListener('DOMContentLoaded', function() {
                const particlesContainer = document.getElementById('particles');
                const particleCount = 30;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    // Random size between 2-6px
                    const size = Math.random() * 4 + 2;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    
                    // Random position
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;
                    
                    // Random animation delay
                    particle.style.animationDelay = `${Math.random() * 15}s`;
                    
                    // Random opacity
                    particle.style.opacity = Math.random() * 0.5 + 0.1;
                    
                    particlesContainer.appendChild(particle);
                }
            });
            
            function openEditModal(id, title, status) {
                if (status === 'selesai') return;
                document.getElementById('editForm').action = '/todos/' + id;
                document.getElementById('editTitle').value = title;
                document.getElementById('editStatusValue').value = 'on going';
                
                const modal = document.getElementById('editModal');
                const modalContent = document.getElementById('editModalContent');
                
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('bg-opacity-70');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
            
            function closeEditModal() {
                const modal = document.getElementById('editModal');
                const modalContent = document.getElementById('editModalContent');
                
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
            
            function openDeleteModal(id, title) {
                document.getElementById('deleteForm').action = '/todos/' + id;
                document.getElementById('deleteTaskTitle').textContent = title;
                
                const modal = document.getElementById('deleteModal');
                const modalContent = document.getElementById('deleteModalContent');
                
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.add('bg-opacity-70');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
            
            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                const modalContent = document.getElementById('deleteModalContent');
                
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        </script>
    </x-layout>
</body>
</html>