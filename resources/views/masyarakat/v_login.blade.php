<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | SKB Subang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://img.icons8.com/color/48/school.png" type="image/png">
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-6">
            <img src="https://img.icons8.com/color/96/school.png" class="mx-auto mb-2" alt="Logo Sekolah">
            <h1 class="text-3xl font-bold text-blue-700">SKB Subang</h1>
            <p class="text-gray-500 text-sm mt-1">Sistem Informasi Pembelajaran</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:ring-blue-500 focus:border-blue-500" required>
                    <button type="button" onclick="togglePassword()" class="absolute top-2.5 right-3 text-gray-500 hover:text-gray-700" title="Lihat Password">👁️</button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Masuk</button>
        </form>

        <p class="mt-6 text-center text-xs text-gray-500">© {{ date('Y') }} SKB Kabupaten Subang</p>
    </div>

    <script>
        function togglePassword() {
            const pass = document.getElementById("password");
            pass.type = pass.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
