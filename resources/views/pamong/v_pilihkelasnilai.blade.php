@extends('pamong.templatepamong')

@section('content')
<div class="container mt-6">
    <h2 class="text-2xl font-semibold mb-4">Pilih Kelas</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($kelas as $k)
            <a href="{{ route('pamong.nilai.pilihtugas', $k->id_kelas) }}"
               class="bg-blue-500 text-white rounded p-4 hover:bg-blue-600">
                {{ $k->nama_kelas }}
            </a>
        @endforeach
    </div>
</div>
@endsection
