@extends('pamong.templatepamong')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard Pamong</h1>

<!-- Statistik Utama -->
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold">Total Tugas</h2>
        <p class="text-3xl mt-2 text-blue-600">{{ $jumlahTugas }}</p>
    </div>
    <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold">Tugas Dikumpulkan</h2>
        <p class="text-3xl mt-2 text-green-600">{{ $jumlahPengumpulan }}</p>
    </div>
    <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold">Jumlah Peserta</h2>
        <p class="text-3xl mt-2 text-purple-600">{{ $jumlahPeserta }}</p>
    </div>
</div>

<!-- Jadwal Pelajaran -->
<div class="bg-white shadow rounded p-4">
    <div class="flex justify-between items-center mb-3">
        <h2 class="text-xl font-semibold">Jadwal Pelajaran Minggu Ini</h2>
    </div>

    @if($jadwalMingguIni->isEmpty())
        <p class="text-gray-500 italic">Belum ada jadwal untuk minggu ini.</p>
    @else
    <table class="min-w-full text-sm border mt-2">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Hari</th>
                <th class="p-2 border">Minggu Ke</th>
                <th class="p-2 border">Jam</th>
                <th class="p-2 border">Mapel</th>
                <th class="p-2 border">Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalMingguIni as $jadwal)
            <tr>
                <td class="p-2 border">{{ $jadwal->hari }}</td>
                <td class="p-2 border">Minggu ke-{{ $jadwal->minggu_ke }}</td>
                <td class="p-2 border">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                <td class="p-2 border">{{ $jadwal->nama_mapel }}</td>
                <td class="p-2 border">{{ $jadwal->nama_kelas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
