@extends('admin.templateadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Mata Pelajaran</h1>

    <form action="{{ route('simpan.mapel') }}" method="POST">
        @csrf

        <!-- Input Nama Mapel -->
        <div class="mb-4">
            <label for="nama_mapel" class="block font-semibold">Nama Mata Pelajaran:</label>
            <input type="text" name="nama_mapel" id="nama_mapel" class="w-full border rounded p-2" required>
        </div>

        <!-- Dropdown Paket -->
        <div class="mb-4">
            <label for="id_paket" class="block font-semibold">Paket Program:</label>
            <select name="id_paket" id="id_paket" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Paket --</option>
                @foreach ($paket as $p)
                    <option value="{{ $p->id_paket }}">{{ $p->nama_paket }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol -->
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin.mapel') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
