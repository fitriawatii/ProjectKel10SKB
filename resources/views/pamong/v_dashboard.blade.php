@extends('pamong.templatepamong')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard Pamong</h1>

<!-- Statistik Utama -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
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
        @php
            $grouped = $jadwalMingguIni->groupBy(['minggu_ke', 'hari']);
        @endphp

        @foreach($grouped as $mingguKe => $perHari)
            <h3 class="text-lg font-bold mb-2 mt-4">Minggu ke-{{ $mingguKe }}</h3>

            <table class="w-full border text-sm mb-4">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border text-left">Hari</th>
                        <th class="p-2 border text-left">Jadwal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perHari as $hari => $jadwals)
                        <tr>
                            <td class="p-2 border font-semibold w-1/4">{{ $hari }}</td>
                            <td class="p-2 border w-3/4">
                                <ul class="space-y-1">
                                    @foreach($jadwals as $j)
                                        <li>
                                            <span class="font-medium">{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</span> :
                                            {{ $j->nama_mapel }} ({{ $j->nama_kelas }})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endif
</div>
@endsection
