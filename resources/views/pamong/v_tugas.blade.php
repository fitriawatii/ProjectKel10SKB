@extends('pamong.templatepamong')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Tugas</h1>

<div class="bg-white rounded shadow p-6">
    <!-- Tombol Kembali, Tambah & Dropdown Tahun Ajaran -->
    <div class="mb-6 flex justify-between items-center flex-wrap">
        <div class="flex items-center space-x-2 mb-2">
            <a href="{{ url()->previous() }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">⬅ Kembali</a>
            <a class="bg-blue-600 text-white px-4 py-2 rounded" href="/pamong/tabeltugas/tambah">➕ Tambah</a>
        </div>

        <form method="GET" action="{{ route('pamong.tugas') }}" class="flex items-center space-x-2 mb-2">
            <label for="id_tahun_ajaran" class="text-sm text-gray-700">Tahun Ajaran:</label>
            <select name="id_tahun_ajaran" id="id_tahun_ajaran" onchange="this.form.submit()" class="border px-3 py-2 rounded">
                @foreach($tahunAjaranList as $ta)
                    <option value="{{ $ta->id_tahun_ajaran }}" {{ $ta->id_tahun_ajaran == $selectedTahun ? 'selected' : '' }}>
                        {{ $ta->tahun_ajaran }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Tabel Tugas -->
    <table class="min-w-full table-auto border border-gray-300">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="border px-4 py-2">Judul Tugas</th>
                <th class="border px-4 py-2">Mata Pelajaran</th>
                <th class="border px-4 py-2">Kelas</th>
                <th class="border px-4 py-2">Deskripsi</th>
                <th class="border px-4 py-2">Deadline</th>
                <th class="border px-4 py-2">File</th>
                <th class="border px-4 py-2">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugas as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->judul_tugas }}</td>
                <td class="border px-4 py-2">{{ $item->nama_mapel }}</td>
                <td class="border px-4 py-2">{{ $item->nama_kelas }}</td>
                <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
                <td class="border px-4 py-2">{{ $item->tanggal_deadline }}</td>
                <td class="border px-4 py-2">
                    @php
                        $fileName = $item->file_tugas;
                        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                        $icon = match(strtolower($ext)) {
                            'pdf' => 'https://cdn-icons-png.flaticon.com/512/337/337946.png',
                            'xls', 'xlsx' => 'https://cdn-icons-png.flaticon.com/512/888/888878.png',
                            'doc', 'docx' => 'https://cdn-icons-png.flaticon.com/512/281/281760.png',
                            'mp4' => 'https://cdn-icons-png.flaticon.com/512/136/136534.png',
                            'jpg', 'jpeg', 'png' => 'https://cdn-icons-png.flaticon.com/512/136/136524.png',
                            default => null
                        };
                    @endphp

                    @if($fileName)
                        <a href="{{ asset('file_tugas/' . $fileName) }}" target="_blank" class="flex items-center space-x-2 text-blue-600 hover:underline">
                            @if($icon)
                                <img src="{{ $icon }}" alt="file icon" class="w-6 h-6">
                            @endif
                            <span>{{ $fileName }}</span>
                        </a>
                    @else
                        <span class="text-gray-400 italic">Tidak ada file</span>
                    @endif
                </td>
                <td class="border px-4 py-2 space-x-2">
                    <a href="/pamong/tabeltugas/edit/{{ $item->id_tugas }}" class="bg-blue-600 text-white px-3 py-1 rounded">✏️</a>
                    <form action="/pamong/tabeltugas/hapus/{{ $item->id_tugas }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
