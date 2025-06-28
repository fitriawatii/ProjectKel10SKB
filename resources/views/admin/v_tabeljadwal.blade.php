@extends('admin.templateadmin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Data Jadwal Pelajaran</h1>

    <form method="GET" action="{{ route('jadwal.index') }}" class="flex items-center gap-3">
        <label for="kelas" class="font-medium">Filter Kelas:</label>
        <select name="kelas" id="kelas" onchange="this.form.submit()" class="border rounded px-3 py-2">
            <option value="">Semua Kelas</option>
            @foreach($kelasList as $k)
                <option value="{{ $k->id_kelas }}" {{ request('kelas') == $k->id_kelas ? 'selected' : '' }}>
                    {{ $k->nama_kelas }}
                </option>
            @endforeach
        </select>
    </form>
</div>

@if(session('success'))
    <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="mb-4">
    <a href="{{ route('jadwal.tambah') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">+ Tambah Jadwal</a>
</div>

@php
    $urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $grouped = $data->groupBy(['minggu_ke', 'hari']);
@endphp

@foreach($grouped as $mingguKe => $perHari)
    {{-- Box Mingguan --}}
    <div class="border-2 border-blue-400 rounded-lg shadow p-4 mb-8 bg-blue-50">
        <h2 class="text-xl font-bold text-blue-700 border-b border-blue-300 pb-1 mb-4">📅 Minggu ke-{{ $mingguKe }}</h2>

        @foreach($urutanHari as $hari)
            @if(isset($perHari[$hari]))
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $hari }}</h3>
                    <table class="w-full border bg-white mb-3 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 border text-left">Jam</th>
                                <th class="p-2 border text-left">Kelas</th>
                                <th class="p-2 border text-left">Mata Pelajaran</th>
                                <th class="p-2 border text-left">Pamong</th>
                                <th class="p-2 border text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perHari[$hari] as $item)
                                <tr>
                                    <td class="p-2 border">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                                    <td class="p-2 border">{{ $item->nama_kelas }}</td>
                                    <td class="p-2 border">{{ $item->nama_mapel }}</td>
                                    <td class="p-2 border">{{ $item->nama_pamong }}</td>
                                    <td class="p-2 border">
                                        <div class="flex gap-2">
                                            <a href="{{ route('jadwal.edit', $item->id_jadwal) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">Edit</a>
                                            <form action="{{ route('jadwal.destroy', $item->id_jadwal) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach
    </div>
@endforeach
@endsection
