@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Materi</h1>

@if(count($dataMateri) > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($dataMateri as $m)
    @php
        $fileName = $m->file ?? '';
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

    <div class="bg-white rounded-xl shadow-md p-4 flex flex-col justify-between h-full">
        <div>
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ $icon }}" alt="file icon" class="w-8 h-8">
                <h2 class="text-lg font-semibold">{{ $m->nama_materi }}</h2>
            </div>
            <p class="text-sm text-gray-600"><strong>Kelas:</strong> {{ $m->kelas }}</p>
            <p class="text-sm text-gray-600 mb-3"><strong>Keterangan:</strong> {{ $m->keterangan_materi }}</p>
        </div>

        @if($m->file)
        <a href="{{ asset('materi/' . $m->file) }}"
           class="mt-auto inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition"
           target="_blank" rel="noopener noreferrer">
            📄 Lihat Materi
        </a>
        @else
        <span class="text-gray-400 italic mt-2">Tidak ada file</span>
        @endif
    </div>
    @endforeach
</div>
@else
    <p class="text-gray-500">Belum ada materi yang tersedia.</p>
@endif
@endsection
