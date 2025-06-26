@extends('pesertadidik.templatepesertadidik')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Peserta Didik</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Tugas -->
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Tugas</h2>
            <p class="text-4xl font-bold text-blue-600">{{ $totalTugas }}</p>
        </div>

        <!-- Tugas Dikumpulkan -->
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Tugas Dikumpulkan</h2>
            <p class="text-4xl font-bold text-green-600">{{ $totalPengumpulan }}</p>
        </div>

        <!-- Rata-Rata Nilai -->
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Rata-Rata Nilai</h2>
            <p class="text-4xl font-bold text-yellow-600">
                {{ $rataRataNilai ?? '-' }}
            </p>
        </div>
    </div>

    <!-- Jadwal Minggu Ini -->
    <div class="bg-white shadow rounded p-6">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl font-semibold">Jadwal Pelajaran Minggu Ini</h2>
        </div>

        @if($jadwalMingguIni->isEmpty())
            <p class="text-gray-500 italic">Belum ada jadwal untuk minggu ini.</p>
        @else
        <table class="w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Hari</th>
                    <th class="p-2 border">Minggu Ke</th>
                    <th class="p-2 border">Jam</th>
                    <th class="p-2 border">Mapel</th>
                    <th class="p-2 border">Pamong</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwalMingguIni as $jadwal)
                <tr>
                    <td class="p-2 border">{{ $jadwal->hari }}</td>
                    <td class="p-2 border">Minggu ke-{{ $jadwal->minggu_ke }}</td>
                    <td class="p-2 border">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td class="p-2 border">{{ $jadwal->nama_mapel }}</td>
                    <td class="p-2 border">{{ $jadwal->nama_pamong }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
