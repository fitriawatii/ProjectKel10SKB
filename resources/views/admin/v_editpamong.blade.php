@extends('admin.templateadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Edit Data Pamong</h1>

    {{-- Menampilkan pesan error validasi --}}
    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit --}}
    <form action="{{ route('update.pamong', $pamong->id_pamong) }}" method="POST">
        @csrf
        {{-- Hanya gunakan POST karena route hanya support POST --}}
        {{-- @method('PUT') tidak perlu jika routenya POST --}}

        <div class="mb-4">
            <label for="nama_pamong" class="block font-semibold mb-1">Nama Pamong</label>
            <input type="text" name="nama_pamong" id="nama_pamong" class="w-full border rounded p-2"
                value="{{ old('nama_pamong', $pamong->nama_pamong) }}" required>
        </div>

        <div class="mb-4">
            <label for="id_mapel" class="block font-semibold mb-1">Mata Pelajaran</label>
            <select name="id_mapel" id="id_mapel" class="w-full border rounded p-2" required>
                <option value="">-- Pilih Mata Pelajaran --</option>
                @foreach ($mapel as $m)
                    <option value="{{ $m->id_mapel }}" {{ $pamong->id_mapel == $m->id_mapel ? 'selected' : '' }}>
                        {{ $m->nama_mapel }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.pamong') }}" class="text-gray-600 hover:underline">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
