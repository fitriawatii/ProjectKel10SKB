<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SKB Pamong</title>
    <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="px-4 py-4 bg-white text-black border-b border-gray-20 w-64">
            <div class="p-4 text-xl font-bold bg-black text-white">SKB</div>
            <div class="px-4 py-4 text-black">
                <div class="mb-4 text-center text-sm text-gray-600">Pamong Belajar SKB</div>
                <nav class="space-y-1">
                    <a href="/pamong/dashboard" class="flex items-center gap-3 py-2 px-4 rounded hover:bg-gray-100 transition">
                        <i class="fas fa-home w-5 text-blue-500"></i> Dashboard
                    </a>
                    <a href="/pamong/tabelmateri" class="flex items-center gap-3 py-2 px-4 rounded hover:bg-gray-100 transition">
                        <i class="fas fa-book-open w-5 text-blue-500"></i> Materi
                    </a>
                    <a href="/pamong/tabeltugas" class="flex items-center gap-3 py-2 px-4 rounded hover:bg-gray-100 transition">
                        <i class="fas fa-tasks w-5 text-blue-500"></i> Tugas
                    </a>
                    <a href="/pamong/nilai" class="flex items-center gap-3 py-2 px-4 rounded hover:bg-gray-100 transition">
                        <i class="fas fa-clipboard-check w-5 text-blue-500"></i> Nilai
                    </a>
                    </a>
                </nav>
                <div class="absolute bottom-0 left-0 w-full px-4 py-3 border-t border-gray-200">
                <a href="/logout" class="block text-center text-blue-600 hover:underline">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="bg-white border-b px-6 py-3 flex justify-end items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2">
                        <div class="bg-gray-300 text-white rounded-full h-8 w-8 flex items-center justify-center text-sm font-semibold">
                            {{ strtoupper(substr(session('user')->nama, 0, 1)) }}
                        </div>
                        <span class="font-medium">{{ session('user')->nama }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 bg-white border rounded shadow w-40 z-10">
                        <a href="{{ route('akun.profil') }}" class="block px-4 py-2 hover:bg-gray-100">Kelola Akun</a>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('text');
    </script>
</body>
</html>
