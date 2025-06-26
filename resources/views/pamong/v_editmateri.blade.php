@extends('pamong.templatepamong')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
            <h4 class="text-lg font-semibold">Edit Materi</h4>
        </div>
        <div class="px-6 py-4">
            <a href="/pamong/tabelmateri" class="inline-block mb-4 text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                Kembali
            </a>

            {{-- Notifikasi sukses dan error --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('update.materi', ['id_materi' => $materi->id_materi]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="id_materi" class="block font-semibold mb-1">ID Materi</label>
                    <input type="text" name="id_materi" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $materi->id_materi }}" readonly>
                    @error('id_materi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_materi" class="block font-semibold mb-1">Nama Materi</label>
                    <input type="text" name="nama_materi" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $materi->nama_materi }}" required>
                    @error('nama_materi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="mapel" class="block font-semibold mb-1">Mapel</label>
                    <select name="id_mapel" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">Pilih Mapel</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                    @error('id_mapel')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="kelas" class="block font-semibold mb-1">Kelas</label>
                    <select name="id_kelas" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    @error('id_kelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="text" class="block font-semibold mb-1">Text</label>
                    <textarea name="keterangan_materi" id="text" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" rows="5" required>{{ $materi->keterangan_materi }}</textarea>
                    @error('keterangan_materi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="file" class="block font-semibold mb-1">Upload File <span class="text-sm text-gray-500">(Max 10MB)</span></label>
                    <input type="file" name="file" class="w-full border border-gray-300 p-2 rounded">
                </div>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
