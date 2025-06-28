@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Manajemen Akun</h1>

{{-- Notifikasi sukses --}}
@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Notifikasi error --}}
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="flex justify-between items-center mb-4 flex-wrap gap-2">
    <a href="{{ route('akun.tambah') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Tambah Akun
    </a>

    <form action="{{ route('akun.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
        {{-- Input Pencarian --}}
        <input type="text" name="cari" placeholder="Cari nama/email/role..." value="{{ request('cari') }}"
               class="border rounded px-3 py-2 w-64" />

        {{-- Dropdown Role --}}
        <select name="role" class="border rounded px-3 py-2">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="pamong" {{ request('role') == 'pamong' ? 'selected' : '' }}>Pamong</option>
            <option value="peserta_didik" {{ request('role') == 'pesertadidik' ? 'selected' : '' }}>Peserta Didik</option>
        </select>

        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded">Filter</button>
    </form>
</div>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border">
        <thead class="bg-gray-100 text-sm">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Role</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($akun as $i => $a)
                <tr>
                    <td class="border px-4 py-2">{{ $i + 1 }}</td>
                    <td class="border px-4 py-2">{{ $a->nama }}</td>
                    <td class="border px-4 py-2">{{ $a->email }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $a->role }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('akun.hapus', $a->id_akun) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500 italic">Tidak ada data akun.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
