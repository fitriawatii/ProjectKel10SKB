@extends('pesertadidik.templatepesertadidik')

@section('content')
<h1 class="text-2xl font-bold mb-6">📘 Pilih Mata Pelajaran (Materi)</h1>

<!-- Filter Tahun Ajaran -->
<form method="GET" action="{{ route('pesertadidik.pilihmapel.materi') }}" class="mb-6">
    <label for="id_tahun_ajaran" class="block mb-2 text-sm font-medium text-gray-700">Pilih Tahun Ajaran:</label>
    <select name="id_tahun_ajaran" id="id_tahun_ajaran" onchange="this.form.submit()" class="border border-gray-300 px-4 py-2 rounded w-64">
        @foreach ($tahunAjaranList as $ta)
            <option value="{{ $ta->id_tahun_ajaran }}" {{ $ta->id_tahun_ajaran == $selectedTahun ? 'selected' : '' }}>
                {{ $ta->tahun_ajaran }}
            </option>
        @endforeach
    </select>
</form>

<!-- Daftar Mapel -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse ($mapelList as $mapel)
        <a href="{{ route('materi.permapel', ['id_mapel' => $mapel->id_mapel, 'id_tahun_ajaran' => $selectedTahun]) }}"
           class="bg-white shadow rounded p-5 hover:bg-blue-50 text-center transition">
            <div class="mb-2">
                <span class="inline-block bg-blue-100 text-blue-600 p-3 rounded-full">📘</span>
            </div>
            <h2 class="text-lg font-semibold">{{ $mapel->nama_mapel }}</h2>
        </a>
    @empty
        <p class="text-gray-500 italic">Tidak ada mata pelajaran ditemukan untuk tahun ajaran ini.</p>
    @endforelse
</div>
@endsection
