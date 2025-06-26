@extends('admin.templateadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Akun Baru</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah Akun --}}
    <form action="{{ route('akun.simpan') }}" method="POST" class="mb-6">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block font-semibold mb-1">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Password</label>
            <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block font-semibold mb-1">Role</label>
            <select name="role" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="">Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="pamong">Pamong</option>
                <option value="peserta_didik">Siswa</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
