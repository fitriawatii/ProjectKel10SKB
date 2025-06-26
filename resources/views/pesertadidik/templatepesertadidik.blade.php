<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SKB Peserta Didik</title>
    <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 px-4 py-4 bg-white text-black border-r border-gray-200">
            <div class="p-4 text-xl font-bold bg-black text-white rounded">SKB</div>
            <div class="px-4 py-4">
                <p class="text-center text-sm text-gray-600">Peserta Didik</p>
                <nav class="mt-4 space-y-1">
                    <a href="/pesertadidik/dashboard" class="flex items-center gap-3 py-2 px-4 hover:bg-gray-100 rounded">
                        <i class="fas fa-home text-blue-500 w-5"></i> Dashboard
                    </a>
                    <a href="/peserta/materi" class="flex items-center gap-3 py-2 px-4 hover:bg-gray-100 rounded">
                        <i class="fas fa-book-open text-blue-500 w-5"></i> Materi
                    </a>
                    <a href="/peserta/tugas" class="flex items-center gap-3 py-2 px-4 hover:bg-gray-100 rounded">
                        <i class="fas fa-tasks text-blue-500 w-5"></i> Tugas
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
            <!-- TOP NAV -->
            <header class="bg-white border-b shadow px-6 py-4 flex justify-end items-center">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(session('user')->nama) }}" alt="Avatar">
                        <span class="font-medium text-sm">{{ session('user')->nama }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <!-- Dropdown -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white shadow-md rounded z-20">
                        <a href="{{ route('akun.profil') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Kelola Akun</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 overflow-y-auto p-6">
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
