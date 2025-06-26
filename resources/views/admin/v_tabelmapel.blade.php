@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Mata Pelajaran</h1>

<div class="bg-white rounded shadow p-6">
    <!-- Tombol Tambah dan Form Pencarian -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('tambah.mapel') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Mapel</a>

        <form action="{{ route('admin.mapel') }}" method="GET" class="flex">
            <input type="text" name="cari" placeholder="Cari mapel/paket..." value="{{ request('cari') }}"
                   class="border rounded-l px-3 py-2 w-64" />
            <button type="submit" class="bg-gray-700 text-white px-4 rounded-r">Cari</button>
        </form>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Mata Pelajaran -->
    <table class="min-w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Nama Mata Pelajaran</th>
                <th class="px-4 py-2 border">Nama Paket</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datamapel as $index => $mapel)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $mapel->nama_mapel }}</td>
                    <td class="border px-4 py-2">{{ $mapel->nama_paket ?? '-' }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ url('/admin/mapel/edit/' . $mapel->id_mapel) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️ Edit</a>
                        <a href="{{ route('hapus.mapel', $mapel->id_mapel) }}"
                           class="bg-red-600 text-white px-3 py-1 rounded"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Tidak ada data mata pelajaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
