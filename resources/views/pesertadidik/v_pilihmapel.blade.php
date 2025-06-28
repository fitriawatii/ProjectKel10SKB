@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">📚 Pilih Mata Pelajaran</h1>

@if(count($mapelList) > 0)
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($mapelList as $mapel)
        <a href="{{ route('materi.permapel', $mapel->id_mapel) }}"
           class="bg-white border border-gray-200 hover:shadow-lg transition duration-200 rounded-xl p-5 flex flex-col items-center text-center hover:bg-blue-50">
            <div class="bg-blue-100 text-blue-600 w-12 h-12 flex items-center justify-center rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6L3 9m9 5l9-5" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-700">{{ $mapel->nama_mapel }}</h2>
        </a>
    @endforeach
</div>
@else
    <p class="text-gray-500 italic">Belum ada mata pelajaran yang tersedia.</p>
@endif
@endsection
