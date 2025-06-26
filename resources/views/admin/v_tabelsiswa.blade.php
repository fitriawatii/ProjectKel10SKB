@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Pesertadidik</h1>

<div class="bg-white rounded shadow p-6">

    <!-- Form Cari -->
    <form method="GET" action="{{ route('admin.datasiswa') }}" class="mb-4">
        <input type="text" name="cari" placeholder="Cari nama atau NISN..."
               value="{{ request('cari') }}"
               class="border px-3 py-2 rounded w-1/3">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Cari</button>
    </form>

    <!-- Tabel Data Ringkas -->
    <table class="min-w-full table-auto border">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">NISN</th>
                <th class="px-4 py-2">Nama Lengkap</th>
                <th class="px-4 py-2">Jenis Kelamin</th>
                <th class="px-4 py-2">Kelas</th>
                <th class="px-4 py-2">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataSiswa as $siswa)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $siswa->nisn }}</td>
                <td class="px-4 py-2">{{ $siswa->nama_lengkap }}</td>
                <td class="px-4 py-2">{{ $siswa->jenis_kelamin }}</td>
                <td class="px-4 py-2">{{ $siswa->kelas }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('siswa.detail', $siswa->id_siswa) }}" class="bg-green-500 text-white px-3 py-1 rounded">🔍 Detail</a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('siswa.hapus', $siswa->id_siswa) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">🗑 Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-gray-500 italic">Tidak ada data ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
