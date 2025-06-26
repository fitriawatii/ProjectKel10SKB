@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Tugas</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded shadow p-6">
    <table class="min-w-full table-auto border">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-2 border">Mata Pelajaran</th>
                <th class="p-2 border">Judul Tugas</th>
                <th class="p-2 border">Deskripsi</th>
                <th class="p-2 border">File</th>
                <th class="p-2 border">Deadline</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Nilai</th>
                <th class="p-2 border">Komentar</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataTugas as $tugas)
                @php
                    $sudahKumpul = isset($tugasDikumpulkan[$tugas->id_tugas]);
                    $fileJawaban = $sudahKumpul ? $tugasDikumpulkan[$tugas->id_tugas] : null;
                    $deadlineLewat = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($tugas->tanggal_deadline));
                @endphp
                <tr class="border-t">
                    <td class="p-2 border">{{ $tugas->nama_mapel }}</td>
                    <td class="p-2 border">{{ $tugas->judul_tugas }}</td>
                    <td class="p-2 border">{{ $tugas->deskripsi }}</td>
                    <td class="p-2 border">
                        @if($tugas->file_tugas)
                            <a href="{{ asset('file_tugas/' . $tugas->file_tugas) }}" class="text-blue-600 underline" target="_blank">Download</a>
                        @else
                            <span class="text-gray-500 italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="p-2 border">
                        {{ $tugas->tanggal_deadline }}
                        @if($deadlineLewat)
                            <span class="text-red-600 text-sm italic">(lewat)</span>
                        @endif
                    </td>
                    <td class="p-2 border">
                        @if($sudahKumpul)
                            <span class="text-green-600 font-semibold">Sudah dikumpulkan</span>
                        @elseif($deadlineLewat)
                            <span class="text-gray-500 font-semibold italic">Terlambat</span>
                        @else
                            <span class="text-red-600 font-semibold">Belum</span>
                        @endif
                    </td>
                    <td class="p-2 border">
                        @if(isset($tugas->nilai))
                            <span class="text-green-700 font-semibold">{{ $tugas->nilai }}</span>
                        @else
                            <span class="text-gray-400 italic">Belum dinilai</span>
                        @endif
                    </td>
                    <td class="p-2 border">
                        @if(isset($tugas->komentar))
                            <span class="text-gray-700">{{ $tugas->komentar }}</span>
                        @else
                            <span class="text-gray-400 italic">-</span>
                        @endif
                    </td>
                    <td class="p-2 border">
                        @if($deadlineLewat && !$sudahKumpul)
                            <span class="text-red-500 italic text-sm">Tidak bisa mengumpulkan</span>
                        @else
                            <form action="{{ route('pesertadidik.kirimTugas') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_tugas" value="{{ $tugas->id_tugas }}">
                                <input type="file" name="file_pengumpulan" class="block mb-1 text-sm" required>
                                @if($sudahKumpul)
                                    <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Update</button>
                                    <a href="{{ asset('jawaban/' . $fileJawaban) }}" target="_blank" class="text-blue-600 underline block mt-1 text-sm">Lihat Jawaban</a>
                                @else
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Kirim</button>
                                @endif
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
