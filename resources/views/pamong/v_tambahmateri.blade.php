@extends('pamong.templatepamong')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h4 class="text-lg font-semibold">Tambah Materi</h4>
        </div>

        <div class="px-6 py-4">
            <a href="/pamong/tabelmateri" class="inline-block mb-4 text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded transition duration-200">
                ← Kembali
            </a>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('insert.materi') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="nama_materi" class="block font-semibold mb-1">Nama Materi</label>
                    <input type="text" name="nama_materi" id="nama_materi"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                           placeholder="Masukkan nama materi" required>
                </div>

                <div class="mb-4">
                    <label for="id_mapel" class="block font-semibold mb-1">Mata Pelajaran</label>
                    <select name="id_mapel" id="id_mapel"
                            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">Pilih Mapel</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="id_kelas" class="block font-semibold mb-1">Kelas</label>
                    <select name="id_kelas" id="id_kelas"
                            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="keterangan_materi" class="block font-semibold mb-1">Keterangan Materi</label>
                    <textarea name="keterangan_materi" id="keterangan_materi"
                              class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                              rows="5" placeholder="Tulis keterangan materi di sini..." required></textarea>
                </div>

                <div class="mb-6">
                    <label for="file" class="block font-semibold mb-1">Upload File</label>
                    <input type="file" name="file" id="file"
                           class="w-full border border-gray-300 p-2 rounded focus:outline-none"
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.mp4,.jpg,.jpeg,.png">
                    <p class="text-sm text-gray-500 mt-1">Maksimal ukuran file 10MB</p>
                </div>

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded transition duration-200">
                    Simpan Materi
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
