@extends(session('user')->role == 'pamong' ? 'pamong.templatepamong' : 
        (session('user')->role == 'peserta_didik' ? 'pesertadidik.templatepesertadidik' : 'admin.templateadmin'))

@section('content')
<div class="max-w-xl mx-auto bg-white shadow rounded p-6 mt-6">
    <h2 class="text-2xl font-bold mb-4">Profil Akun</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('profil.update') }}" method="POST">
        @csrf

        {{-- Nama --}}
<div class="mb-4">
    <label class="block font-medium mb-1">Nama</label>
    <input type="text" name="nama" value="{{ old('nama', session('user')->nama) }}"
        class="w-full border px-3 py-2 rounded bg-gray-100 cursor-not-allowed" readonly>
</div>


        {{-- Email --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', session('user')->email) }}"
                class="w-full border px-3 py-2 rounded @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Lama --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Password Lama</label>
            <input type="password" name="password_lama"
                class="w-full border px-3 py-2 rounded @error('password_lama') border-red-500 @enderror">
            @error('password_lama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Baru --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Password Baru (opsional)</label>
            <input type="password" name="password"
                class="w-full border px-3 py-2 rounded @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
