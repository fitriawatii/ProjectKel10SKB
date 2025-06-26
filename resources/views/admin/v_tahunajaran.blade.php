@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Manajemen Tahun Ajaran</h1>

{{-- Pesan sukses --}}
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Form tambah tahun ajaran --}}
<div class="bg-white p-4 rounded shadow mb-6">
    <form action="{{ route('admin.tahunajaran.store') }}" method="POST">
        @csrf
        <div class="flex flex-col md:flex-row items-start md:items-center gap-3">
            <input type="text" name="tahun_ajaran" placeholder="Contoh: 2025/2026"
                class="border rounded p-2 w-full md:w-64" required>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Tahun Ajaran</button>
        </div>
    </form>
</div>

{{-- Tabel tahun ajaran --}}
<div class="overflow-x-auto">
    <table class="min-w-full border table-auto">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-2 border">#</th>
                <th class="p-2 border">Tahun Ajaran</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataTahun as $index => $tahun)
            <tr>
                <td class="p-2 border">{{ $index + 1 }}</td>
                <td class="p-2 border">{{ $tahun->tahun_ajaran }}</td>
                <td class="p-2 border">
                    @if($tahun->is_active)
                        <span class="text-green-600 font-semibold">Aktif</span>
                    @else
                        <span class="text-gray-600">Tidak Aktif</span>
                    @endif
                </td>
                <td class="p-2 border">
                    @if(!$tahun->is_active)
                    <form action="{{ route('admin.tahunajaran.setAktif', $tahun->id_tahun_ajaran) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-green-600 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Jadikan tahun ajaran ini aktif?')">Set Aktif</button>
                    </form>
                    @endif
                    <form action="{{ route('admin.tahunajaran.destroy', $tahun->id_tahun_ajaran) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
