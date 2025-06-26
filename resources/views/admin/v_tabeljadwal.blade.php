@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Jadwal Pelajaran</h1>

@if(session('success'))
    <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="mb-4">
    <a href="{{ route('jadwal.tambah') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Jadwal</a>
</div>

<table class="min-w-full border bg-white">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">Minggu Ke</th>
            <th class="p-2 border">Hari</th>
            <th class="p-2 border">Jam</th>
            <th class="p-2 border">Kelas</th>
            <th class="p-2 border">Mapel</th>
            <th class="p-2 border">Pamong</th>
            <th class="p-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td class="p-2 border">Minggu ke-{{ $item->minggu_ke }}</td>
            <td class="p-2 border">{{ $item->hari }}</td>
            <td class="p-2 border">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
            <td class="p-2 border">{{ $item->nama_kelas }}</td>
            <td class="p-2 border">{{ $item->nama_mapel }}</td>
            <td class="p-2 border">{{ $item->nama_pamong }}</td>
            <td class="p-2 border flex gap-2">
                <a href="{{ route('jadwal.edit', $item->id_jadwal) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">Edit</a>
                <form action="{{ route('jadwal.destroy', $item->id_jadwal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection