@extends('pamong.templatepamong')

@section('content')
<div class="p-6">
    <p class="text-sm text-gray-600 mb-6">
        Data ini diatur oleh administrator, jika ada perubahan bisa hubungi admin
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Kelas di-nonaktifkan dulu karena tidak digunakan --}}
        {{-- 
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-lg font-semibold text-blue-600 mb-2">Kelas Saya</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($kelasSaya as $kelas)
                    <li>{{ $kelas->kelas }}</li>
                @endforeach
            </ul>
        </div>
        --}}

        <div class="bg-white rounded shadow p-4">
            <h2 class="text-lg font-semibold text-blue-600 mb-2">Mapel & Pamong</h2>
            <ul class="list-disc list-inside text-gray-700">
                @foreach($mapelSaya as $item)
                    <li>{{ $item->nama_mapel }} ({{ $item->nama_pamong }})</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
