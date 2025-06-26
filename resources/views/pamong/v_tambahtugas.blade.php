@extends('pamong.templatepamong')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-4">Daftar Tugas</h1>

    {{-- Form Tambah Tugas --}}
    <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf

        <div class="mb-4">
            <label for="id_mapel" class="block font-semibold mb-1">Mapel</label>
            <select name="id_mapel" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="">Pilih Mapel</option>
                @foreach($mapel as $m)
                    <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="id_kelas" class="block font-semibold mb-1">Kelas</label>
            <select name="id_kelas" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="judul_tugas" class="block font-semibold mb-1">Judul Tugas</label>
            <input type="text" name="judul_tugas" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="tanggal_deadline" class="block font-semibold mb-1">Deadline</label>
            <input type="date" name="tanggal_deadline" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="file_tugas" class="block font-semibold mb-1">File Tugas</label>
            <input type="file" name="file_tugas" class="w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
