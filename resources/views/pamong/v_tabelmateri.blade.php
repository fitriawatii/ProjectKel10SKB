@extends('pamong.templatepamong')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Materi</h1>

<div class="bg-white rounded shadow p-6">
    <div class="mb-4 flex justify-between items-center">
        <a class="bg-blue-600 text-white px-4 py-2 rounded mr-2" href="/pamong/tabelmateri/tambah">Tambah</a>
    </div>

    <table class="min-w-full table-auto border border-gray-300">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="border border-gray-300 px-4 py-2">Nama Materi</th>
                <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                <th class="border border-gray-300 px-4 py-2">Kelas</th>
                <th class="border border-gray-300 px-4 py-2">Keterangan Materi</th>
                <th class="border border-gray-300 px-4 py-2">File</th>
                <th class="border border-gray-300 px-4 py-2">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materi as $materi)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $materi->nama_materi }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $materi->nama_mapel }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $materi->nama_kelas }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $materi->keterangan_materi }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @php
                        $fileName = $materi->file;
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

                    @if($materi->file)
                        <a href="{{ asset('materi/' . $fileName) }}" class="flex items-center space-x-2 text-blue-600 hover:underline" target="_blank">
                            @if($icon)
                                <img src="{{ $icon }}" alt="file icon" class="w-6 h-6">
                            @endif
                            <span>{{ $fileName }}</span>
                        </a>
                    @else
                        <span class="text-gray-400 italic">Tidak ada file</span>
                    @endif
                </td>

                <td class="border border-gray-300 px-4 py-2 space-x-2">
                    <a href="/pamong/tabelmateri/edit/{{ $materi->id_materi }}" class="bg-blue-600 text-white px-3 py-1 rounded">✏️</a>
                    <form action="/pamong/tabelmateri/hapus/{{ $materi->id_materi }}" 
                          method="POST" 
                          class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
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
