@extends('pamong.templatepamong')

@section('content')
<div class="container mt-6">
    <h2 class="text-2xl font-semibold mb-4">Pilih Tugas</h2>
    <div class="flex items-center space-x-2 mb-2">
        <a href="{{ url()->previous() }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">⬅ Kembali</a>
</div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($tugas as $t)
            <a href="{{ route('pamong.nilai.detail', $t->id_tugas) }}"
               class="bg-blue-400 text-white rounded p-4 hover:bg-blue-500">
                {{ $t->judul_tugas }}
            </a>
        @endforeach
    </div>
</div>
@endsection
