@extends('pamong.templatepamong')

@section('content')
<div class="container mx-auto mt-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pilih Kelas Untuk Melihat Daftar Tugas</h1>

    @if(!empty($kelas) && count($kelas) > 0)
        <div class="grid gap-4 grid-cols-[repeat(auto-fit,_minmax(220px,_1fr))]">
            @foreach ($kelas as $k)
                <a href="{{ url('pamong/tugas/kelas/' . $k->id_kelas) }}"
                   class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg px-6 py-5 shadow hover:shadow-lg hover:scale-[1.02] transition-all duration-200 h-24 flex items-center justify-center">
                    <div class="text-lg font-semibold">
                        {{ $k->nama_kelas }}
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-gray-500 italic text-lg">
            Anda belum terdaftar mengajar di kelas manapun.
        </div>
    @endif
</div>
@endsection
