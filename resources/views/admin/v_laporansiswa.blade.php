@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Laporan Nilai Per Siswa</h1>

<div class="bg-white rounded shadow p-6">

    <!-- Form Cari -->
    <form method="GET" action="{{ route('admin.laporannilai.persiswa') }}" class="mb-4">
        <input type="text" name="cari" placeholder="Cari nama atau NISN..."
               value="{{ request('cari') }}"
               class="border px-3 py-2 rounded w-1/3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Cari</button>
    </form>

    <!-- Tabel Data -->
    <table class="min-w-full table-auto border">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">NISN</th>
                <th class="px-4 py-2">Nama Lengkap</th>
                <th class="px-4 py-2">Kelas</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswa as $item)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $item->nisn }}</td>
                <td class="px-4 py-2">{{ $item->nama_lengkap }}</td>
                <td class="px-4 py-2">{{ $item->nama_kelas }}</td>
                <td class="px-4 py-2 space-x-2">
                    <!-- Tombol Cetak -->
                    <a href="{{ route('admin.laporannilai.persiswa.cetak', $item->id_siswa) }}"
                       class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                       Cetak
                    </a>

                    <!-- Tombol Download -->
                    <a href="{{ route('admin.laporannilai.persiswa.download', $item->id_siswa) }}"
                       class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                       Download
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4 text-gray-500 italic">Tidak ada data siswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
