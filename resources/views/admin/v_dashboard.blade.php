@extends('admin.templateadmin')
@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white rounded shadow p-6 text-center">
        <p class="font-semibold">Jumlah Data Pamong</p>
        <p class="text-blue-600 text-3xl font-bold">{{ $jumlahPamong }}</p>
    </div>

    <div class="bg-white rounded shadow p-6 text-center">
        <p class="font-semibold">Jumlah Data Siswa</p>
        <p class="text-blue-600 text-3xl font-bold">{{ $jumlahSiswa }}</p>
    </div>

    <div class="bg-white rounded shadow p-6 text-center">
        <p class="font-semibold">Jumlah Data Kelas</p>
        <p class="text-blue-600 text-3xl font-bold">{{ $jumlahKelas }}</p>
    </div>

    <div class="bg-white rounded shadow p-6 text-center">
        <p class="font-semibold">Jumlah Data Mapel</p>
        <p class="text-blue-600 text-3xl font-bold">{{ $jumlahMapel }}</p>
    </div>
</div>
@endsection
