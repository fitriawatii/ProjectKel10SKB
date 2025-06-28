@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-4">📘 Daftar Materi</h1>
<a href="{{ route('materi.mapel') }}" class="text-sm text-blue-600 hover:underline mb-6 inline-block">← Kembali ke daftar mata pelajaran</a>

@if(count($materiList) > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($materiList as $materi)
        @php
            $fileName = $materi->file ?? '';
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $icon = match(strtolower($ext)) {
                'pdf' => 'https://cdn-icons-png.flaticon.com/512/337/337946.png',
                'xls', 'xlsx' => 'https://cdn-icons-png.flaticon.com/512/888/888878.png',
                'doc', 'docx' => 'https://cdn-icons-png.flaticon.com/512/281/281760.png',
                'mp4' => 'https://cdn-icons-png.flaticon.com/512/136/136534.png',
                'jpg', 'jpeg', 'png' => 'https://cdn-icons-png.flaticon.com/512/136/136524.png',
                default => 'https://cdn-icons-png.flaticon.com/512/833/833524.png'
            };
        @endphp

        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-5 flex flex-col h-full border border-gray-100">
            <div class="flex items-center mb-3 space-x-3">
                <img src="{{ $icon }}" alt="File Icon" class="w-10 h-10">
                <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $materi->nama_materi }}</h2>
            </div>

            <p class="text-sm text-gray-600 flex-grow">{{ $materi->keterangan_materi }}</p>

            @if($materi->file)
            <a href="{{ asset('materi/'.$materi->file) }}" target="_blank"
               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded text-center transition">
                📂 Lihat Materi
            </a>
            @else
            <span class="mt-4 text-gray-400 italic text-sm">Tidak ada file tersedia</span>
            @endif
        </div>
    @endforeach
</div>
@else
    <p class="text-gray-500 italic">Tidak ada materi untuk mata pelajaran ini.</p>
@endif
@endsection
