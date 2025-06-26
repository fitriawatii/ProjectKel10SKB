<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - SKB Peserta Didik</title>
    <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 px-4 py-4 bg-white text-black border-r border-gray-200 flex flex-col justify-between">
            <div>
                <div class="p-4 text-xl font-bold bg-black text-white text-center">SKB</div>
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">Peserta Didik</p>
                </div>
                <nav class="mt-6 space-y-1">
                    <a href="/peserta" class="block py-2 px-4 rounded hover:bg-gray-100">Dashboard</a>
                    <a href="/peserta/materi" class="block py-2 px-4 rounded hover:bg-gray-100">Materi</a>
                    <a href="/peserta/tugas" class="block py-2 px-4 rounded hover:bg-gray-100">Tugas</a>
                    <a href="/peserta/ujian" class="block py-2 px-4 rounded hover:bg-gray-100">Ujian</a>
                </nav>
            </div>
            <div class="p-4 text-sm">
                <a href="/logout" class="text-blue-600 hover:underline">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="mb-4">
                <h1 class="text-2xl font-bold">@yield('page')</h1>
            </div>
            @yield('content')
        </main>
    </div>

    <!-- CKEditor (optional usage) -->
    <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
    <script>
        if (document.getElementById('text')) {
            CKEDITOR.replace('text');
        }
    </script>
</body>
</html>
