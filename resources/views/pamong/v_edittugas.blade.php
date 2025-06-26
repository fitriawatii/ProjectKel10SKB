@extends('pamong.templatepamong')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
            <h4 class="text-lg font-semibold">Edit Tugas</h4>
        </div>
        <div class="px-6 py-4">
            <a href="{{ route('tugas') }}" class="inline-block mb-4 text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                Kembali
            </a>

            @if(session('success'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-300 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/pamong/tabeltugas/update/' . $tugas->id_tugas) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="judul_tugas" class="block font-semibold mb-1">Judul Tugas</label>
                    <input type="text" name="judul_tugas" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $tugas->judul_tugas }}" required>
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">{{ $tugas->deskripsi }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="id_mapel" class="block font-semibold mb-1">Mata Pelajaran</label>
                    <select name="id_mapel" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id_mapel }}" {{ $tugas->id_mapel == $m->id_mapel ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="id_kelas" class="block font-semibold mb-1">Kelas</label>
                    <select name="id_kelas" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}" {{ $tugas->id_kelas == $k->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tanggal_deadline" class="block font-semibold mb-1">Tanggal Deadline</label>
                    <input type="date" name="tanggal_deadline" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $tugas->tanggal_deadline }}" required>
                </div>

                <div class="mb-4">
                    <label for="file_tugas" class="block font-semibold mb-1">File Tugas <span class="text-sm text-gray-500">(Opsional)</span></label>
                    <input type="file" name="file_tugas" class="w-full border border-gray-300 p-2 rounded">
                    @if($tugas->file_tugas)
                        <p class="text-sm text-gray-600 mt-1">File saat ini: {{ $tugas->file_tugas }}</p>
                    @endif
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Update Tugas
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
