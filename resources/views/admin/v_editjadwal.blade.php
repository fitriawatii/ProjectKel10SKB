@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Jadwal Pelajaran</h1>

<form action="{{ route('jadwal.update', $data->id_jadwal) }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Minggu Ke</label>
        <select name="minggu_ke" class="w-full border p-2 rounded" required>
            @for($i = 1; $i <= 4; $i++)
                <option value="{{ $i }}" {{ $data->minggu_ke == $i ? 'selected' : '' }}>Minggu ke-{{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Hari</label>
        <select name="hari" class="w-full border p-2 rounded" required>
            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                <option value="{{ $hari }}" {{ $data->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Jam Mulai</label>
        <input type="time" name="jam_mulai" class="w-full border p-2 rounded" value="{{ $data->jam_mulai }}" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Jam Selesai</label>
        <input type="time" name="jam_selesai" class="w-full border p-2 rounded" value="{{ $data->jam_selesai }}" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Kelas</label>
        <select name="id_kelas" class="w-full border p-2 rounded" required>
            @foreach($kelas as $k)
                <option value="{{ $k->id_kelas }}" {{ $data->id_kelas == $k->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Mapel</label>
        <select name="id_mapel" class="w-full border p-2 rounded" required>
            @foreach($mapel as $m)
                <option value="{{ $m->id_mapel }}" {{ $data->id_mapel == $m->id_mapel ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-6">
        <label class="block mb-1 font-semibold">Pamong</label>
        <select name="id_pamong" class="w-full border p-2 rounded" required>
            @foreach($pamong as $p)
                <option value="{{ $p->id_pamong }}" {{ $data->id_pamong == $p->id_pamong ? 'selected' : '' }}>{{ $p->nama_pamong }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('jadwal.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </div>
</form>
@endsection
