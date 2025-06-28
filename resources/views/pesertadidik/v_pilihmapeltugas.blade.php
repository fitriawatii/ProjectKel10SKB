@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-2xl font-bold mb-6">📚 Pilih Mata Pelajaran</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($mapelList as $mapel)
        <a href="{{ route('tugas.permapel', $mapel->id_mapel) }}"
           class="bg-white shadow rounded p-5 hover:bg-blue-50 text-center transition">
            <div class="mb-2">
                <span class="inline-block bg-blue-100 text-blue-600 p-3 rounded-full">
                    📘
                </span>
            </div>
            <h2 class="text-lg font-semibold">{{ $mapel->nama_mapel }}</h2>
        </a>
    @endforeach
</div>
@endsection
