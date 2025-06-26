@extends('admin.templateadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Pamong</h1>

    <form action="{{ route('simpan.pamong') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nama_pamong" class="block font-semibold">Nama Pamong:</label>
            <input type="text" name="nama_pamong" id="nama_pamong" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label for="id_mapel" class="block font-semibold">Mata Pelajaran:</label>
            <select name="id_mapel" id="id_mapel" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Mapel --</option>
                @foreach ($mapel as $m)
                    <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('admin.pamong') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
