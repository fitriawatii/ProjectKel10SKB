@extends('admin.templateadmin')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Kelola Laporan Nilai</h1>
    <p class="mb-6 text-gray-600">Silakan pilih jenis laporan yang ingin dicetak:</p>

    <div class="space-y-4">
        <a href="{{ route('admin.laporannilai.persiswa') }}" 
           class="block bg-blue-600 text-white text-center py-3 rounded hover:bg-blue-700 transition">
            📄 Cetak Nilai Per Siswa/Pesertadidik
        </a>

        <a href="{{ route('admin.laporannilai.permapel') }}" 
           class="block bg-green-600 text-white text-center py-3 rounded hover:bg-green-700 transition">
            📘 Cetak Nilai Per Mata Pelajaran
        </a>
    </div>
</div>
@endsection
