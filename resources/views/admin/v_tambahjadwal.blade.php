@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Jadwal Pelajaran</h1>

<form action="{{ route('jadwal.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
            <label for="id_kelas" class="block text-sm font-semibold mb-1">Kelas</label>
            <select name="id_kelas" class="border p-2 rounded w-full" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <hr class="my-4">

    <!-- Container untuk input mapel -->
    <div id="mapel-container">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 mapel-row">
            <div>
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai[]" class="border p-2 rounded w-full" required>
            </div>

            <div>
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai[]" class="border p-2 rounded w-full" required>
            </div>

            <div>
                <label>Mata Pelajaran</label>
                <select name="id_mapel[]" class="border p-2 rounded w-full" required>
                    <option value="">Pilih Mapel</option>
                    @foreach($mapel as $m)
                        <option value="{{ $m->id_mapel }}">{{ $m->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Pamong</label>
                <select name="id_pamong[]" class="border p-2 rounded w-full" required>
                    <option value="">Pilih Pamong</option>
                    @foreach($pamong as $p)
                        <option value="{{ $p->id_pamong }}">{{ $p->nama_pamong }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Tombol tambah mapel -->
    <button type="button" onclick="tambahMapel()" class="bg-blue-500 text-white px-4 py-2 rounded mb-6">+ Tambah Mapel</button>

    <div class="mt-4">
        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white p-2 rounded">Simpan Jadwal</button>
    </div>
</form>

<div class="mt-4">
    <a href="{{ route('jadwal.index') }}" class="text-blue-600 hover:underline">← Kembali ke Jadwal</a>
</div>

<!-- Script clone -->
<script>
function tambahMapel() {
    const container = document.getElementById('mapel-container');
    const original = container.querySelector('.mapel-row');
    const clone = original.cloneNode(true);

    // Reset nilai input/select di clone
    clone.querySelectorAll('input, select').forEach(el => {
        if (el.tagName === 'SELECT') {
            el.selectedIndex = 0;
        } else {
            el.value = '';
        }
    });

    container.appendChild(clone);
}
</script>
@endsection
