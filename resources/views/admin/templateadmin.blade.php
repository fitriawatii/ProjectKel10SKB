<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SKB Admin</title>
    <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans text-sm">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-60 px-3 py-4 bg-white text-black border-r border-gray-200 shadow text-sm">
            <div class="p-3 text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded">
                SKB
            </div>
            <div class="px-3 py-3 text-center">
                <p class="text-xs text-gray-500">Admin SKB</p>
            </div>
            <nav class="space-y-1">
                <a href="/admin" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-home w-4 text-blue-500"></i> Dashboard
                </a>
                <a href="/admin/tabelsiswa" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-users w-4 text-blue-500"></i> Peserta Didik
                </a>
                <a href="/admin/tabelpamong" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-chalkboard-teacher w-4 text-blue-500"></i> Pamong Belajar
                </a>
                <a href="/akun" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-user w-4 text-blue-500"></i> Akun/User
                </a>
                <a href="/admin/tabelpaket" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-layer-group w-4 text-blue-500"></i> Program
                </a>
                <a href="/admin/tabelkelas" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-school w-4 text-blue-500"></i> Kelas
                </a>
                <a href="/admin/tabelmapel" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-book w-4 text-blue-500"></i> Mata Pelajaran
                </a>
                <a href="/jadwal" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-calendar-alt w-4 text-blue-500"></i> Jadwal KBM
                </a>
                <a href="/tahunajaran" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-calendar-alt w-4 text-blue-500"></i> Tahun Ajaran
                </a>
                <a href="/admin/formulirprogram" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-user-edit w-4 text-blue-500"></i> Kelola Peserta Didik Program
                </a>
                <a href="/admin/tabelpamong" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-child w-4 text-blue-500"></i> Kelola Peserta Didik Paud
                </a>
                <a href="/admin/laporannilai" class="flex items-center gap-2 py-1.5 px-3 rounded hover:bg-blue-50 transition">
                    <i class="fas fa-file-alt w-4 text-blue-500"></i> Kelola Laporan
                </a>
            </nav>
            <div class="absolute bottom-0 left-0 w-full px-4 py-3 border-t border-gray-200">
                <a href="/logout" class="block text-center text-blue-600 hover:underline text-sm">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <div class="bg-white border-b px-5 py-3 flex justify-end items-center text-sm">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2">
                        <div class="bg-gray-300 text-white rounded-full h-8 w-8 flex items-center justify-center text-xs font-semibold">
                            {{ strtoupper(substr(session('user')->nama, 0, 1)) }}
                        </div>
                        <span class="font-medium">{{ session('user')->nama }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white border rounded shadow z-10">
                        <a href="{{ route('akun.profil') }}" class="block px-4 py-2 hover:bg-gray-100">Kelola Profil</a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <main class="flex-1 p-5 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
