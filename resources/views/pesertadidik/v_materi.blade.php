@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-2xl font-bold mb-6">Daftar Materi</h1>
<a href="{{ route('materi.mapel') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">← Kembali ke daftar mapel</a>
@if(count($materiList) > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($materiList as $materi)
            <div class="bg-white rounded shadow p-4 hover:shadow-lg transition">
                <h2 class="font-semibold">{{ $materi->nama_materi }}</h2>
                <p class="text-sm text-gray-600 mt-1">{{ $materi->keterangan_materi }}</p>
                <a href="{{ asset('materi/'.$materi->file) }}" class="text-blue-500 text-sm mt-2 inline-block">Lihat Materi →</a>
            </div>
        @endforeach
    </div>
@else
    <p class="text-gray-600">Tidak ada materi untuk mata pelajaran ini.</p>
@endif
@endsection
