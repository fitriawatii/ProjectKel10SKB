@extends('pesertadidik.templatepesertadidik')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Peserta Didik</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Tugas</h2>
            <p class="text-4xl font-bold text-blue-600">{{ $totalTugas }}</p>
        </div>
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Tugas Dikumpulkan</h2>
            <p class="text-4xl font-bold text-green-600">{{ $totalPengumpulan }}</p>
        </div>
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Rata-Rata Nilai</h2>
            <p class="text-4xl font-bold text-yellow-600">{{ $rataRataNilai ?? '-' }}</p>
        </div>
    </div>

    <!-- Jadwal -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold mb-3">Jadwal Pelajaran Minggu Ini</h2>

        @if($jadwalMingguIni->isEmpty())
            <p class="text-gray-500 italic">Belum ada jadwal untuk minggu ini.</p>
        @else
            @php
                $grouped = $jadwalMingguIni->groupBy(['minggu_ke', 'hari']);
                $urutanHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            @endphp

            @foreach($grouped as $mingguKe => $perHari)
                <h3 class="text-lg font-bold mb-2 mt-4">Minggu ke-{{ $mingguKe }}</h3>

                <table class="w-full border text-sm mb-4 bg-white shadow">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 border w-1/4">Hari</th>
                            <th class="p-2 border w-1/2">Jadwal</th>
                            <th class="p-2 border w-1/4">Pamong</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($urutanHari as $hari)
                            @if(isset($perHari[$hari]))
                                <tr>
                                    <td class="p-2 border font-semibold align-top">{{ $hari }}</td>
                                    <td class="p-2 border align-top">
                                        <ul class="space-y-1">
                                            @foreach($perHari[$hari] as $j)
                                                <li>
                                                    <strong>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</strong> :
                                                    {{ $j->nama_mapel ?? '' }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="p-2 border align-top">
                                        <ul class="space-y-1">
                                            @foreach($perHari[$hari] as $j)
                                                <li>{{ $j->nama_pamong ?? '' }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @endif
    </div>
</div>
@endsection
