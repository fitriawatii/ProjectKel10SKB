@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Jadwal Pelajaran</h1>

<form action="{{ route('jadwal.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf

    <div>
        <label for="minggu_ke" class="block text-sm font-semibold mb-1">Minggu Ke</label>
        <select name="minggu_ke" class="border p-2 rounded w-full" required>
            <option value="">Pilih Minggu</option>
            <option value="1">Minggu ke-1</option>
            <option value="2">Minggu ke-2</option>
            <option value="3">Minggu ke-3</option>
            <option value="4">Minggu ke-4</option>
        </select>
    </div>

    <div>
        <label for="hari" class="block text-sm font-semibold mb-1">Hari</label>
        <select name="hari" class="border p-2 rounded w-full" required>
            <option value="">Pilih Hari</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Minggu">Minggu</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Jam Mulai</label>
        <input type="time" name="jam_mulai" class="border p-2 rounded w-full" required>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Jam Selesai</label>
        <input type="time" name="jam_selesai" class="border p-2 rounded w-full" required>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Kelas</label>
        <select name="id_kelas" class="border p-2 rounded w-full" required>
            <option value="">Pilih Kelas</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Mapel</label>
        <select name="id_mapel" class="border p-2 rounded w-full" required>
            <option value="">Pilih Mapel</option>
            @foreach($mapel as $m)
                <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Pamong</label>
        <select name="id_pamong" class="border p-2 rounded w-full" required>
            <option value="">Pilih Pamong</option>
            @foreach($pamong as $p)
                <option value="{{ $p->id_pamong }}">{{ $p->nama_pamong }}</option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2">
        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white p-2 rounded">Simpan Jadwal</button>
    </div>
</form>

<div class="mt-4">
    <a href="{{ route('jadwal.index') }}" class="text-blue-600 hover:underline">← Kembali ke Jadwal</a>
</div>
@endsection
