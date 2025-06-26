@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Pamong Belajar</h1>

<div class="bg-white rounded shadow p-6">
    <!-- Tombol Tambah dan Form Pencarian -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('tambah.pamong') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Pamong</a>

        <form action="{{ route('admin.pamong') }}" method="GET" class="flex">
            <input type="text" name="cari" placeholder="Cari pamong/mapel..." value="{{ request('cari') }}"
                   class="border rounded-l px-3 py-2 w-64" />
            <button type="submit" class="bg-gray-700 text-white px-4 rounded-r">Cari</button>
        </form>
    </div>

    <!-- Tabel Pamong -->
    <table class="min-w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Nama Pamong</th>
                <th class="px-4 py-2 border">Mata Pelajaran</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datapamong as $index => $pamong)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $pamong->nama_pamong }}</td>
                    <td class="border px-4 py-2">{{ $pamong->nama_mapel }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ url('/admin/pamong/edit/' . $pamong->id_pamong) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️ Edit</a>
                        <form action="{{ url('/admin/pamong/delete/' . $pamong->id_pamong) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded" onclick="return confirm('Yakin ingin menghapus data ini?')">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500 italic">Tidak ada data pamong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
