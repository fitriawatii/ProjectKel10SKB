@extends('pamong.templatepamong')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Pilih Kelas Untuk Melihat Daftar Materi</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @forelse ($kelas as $k)
            <a href="{{ url('pamong/materi/kelas/' . $k->id_kelas) }}"
               class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg px-6 py-5 shadow hover:shadow-lg hover:scale-[1.02] transition-all duration-200 h-24 flex items-center justify-center">
                <div class="text-lg font-semibold">{{ $k->nama_kelas }}</div>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500 italic">Tidak ada kelas yang Anda ajar.</div>
        @endforelse
    </div>
</div>
@endsection
