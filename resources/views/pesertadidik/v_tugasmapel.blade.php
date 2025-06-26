@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-2xl font-bold mb-6">Pilih Mata Pelajaran</h1>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach ($mapel as $m)
        <a href="{{ route('tugas.bymapel', $m->id_mapel) }}"
           class="block p-4 bg-white shadow rounded text-center hover:bg-blue-50 transition">
            <span class="font-medium">{{ $m->nama_mapel }}</span>
        </a>
    @endforeach
</div>
@endsection
