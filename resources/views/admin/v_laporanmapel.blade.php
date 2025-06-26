@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Laporan Nilai per Mata Pelajaran</h1>

<div class="bg-white rounded shadow p-6">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full table-auto border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">#</th>
                <th class="px-4 py-2 text-left">Nama Mata Pelajaran</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mapelList as $index => $mapel)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $index + 1 }}</td>
                <td class="px-4 py-2">{{ $mapel->nama_mapel }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="{{ route('admin.laporannilai.permapel.cetak', $mapel->id_mapel) }}"
                       class="bg-blue-600 text-white px-3 py-1 rounded">
                       🖨️ Cetak
                    </a>
                    <a href="{{ route('admin.laporannilai.permapel.download', $mapel->id_mapel) }}"
                       class="bg-red-600 text-white px-3 py-1 rounded">
                       ⬇ Download PDF
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-gray-500 italic py-4">Tidak ada data mata pelajaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
