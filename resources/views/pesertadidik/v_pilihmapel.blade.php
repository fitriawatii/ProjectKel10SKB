@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-2xl font-bold mb-6">Pilih Mata Pelajaran</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($mapelList as $mapel)
        <a href="{{ route('materi.permapel', $mapel->id_mapel) }}" class="bg-white shadow p-4 rounded hover:bg-blue-50">
            <h2 class="text-lg font-semibold text-blue-600">{{ $mapel->nama_mapel }}</h2>
        </a>
    @endforeach
</div>
@endsection
