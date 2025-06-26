@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Data Tugas</h1>

{{-- Notifikasi --}}
@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded shadow p-6">
    <div x-data="{ showModal: false, rows: [0] }">
        <!-- Tombol Tambah -->
        <button class="bg-blue-600 text-white px-4 py-2 rounded mb-4" @click="showModal = true">Tambah Tugas</button>

        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white w-11/12 max-w-4xl p-6 rounded shadow-lg" @click.outside="showModal = false">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Tambah Tugas</h2>
                    <button @click="showModal = false" class="text-gray-500 hover:text-red-600 text-xl">×</button>
                </div>

                <form action="{{ route('tambah.tugas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="w-full table-auto text-sm mb-4">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2">Judul</th>
                                <th class="p-2">Deskripsi</th>
                                <th class="p-2">Mapel</th>
                                <th class="p-2">Kelas</th>
                                <th class="p-2">Deadline</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(row, index) in rows" :key="index">
                                <tr>
                                    <td class="p-2">
                                        <input type="text" :name="`tugas[${index}][judul]`" class="border rounded w-full px-2 py-1" required>
                                    </td>
                                    <td class="p-2">
                                        <input type="text" :name="`tugas[${index}][deskripsi]`" class="border rounded w-full px-2 py-1" required>
                                    </td>
                                    <td class="p-2">
                                        <select :name="`tugas[${index}][mapel]`" class="border rounded w-full px-2 py-1" required>
                                            <option value="">Pilih</option>
                                            @foreach($datatugas as $m)
                                                <option value="{{ $m->id_mapel }}">{{ $m->mapel }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <select :name="`tugas[${index}][kelas]`" class="border rounded w-full px-2 py-1" required>
                                            <option value="">Pilih</option>
                                            @foreach($kelas as $k)
                                                <option value="{{ $k->id_kelas }}">{{ $k->kelas }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="p-2">
                                        <input type="date" :name="`tugas[${index}][deadline]`" class="border rounded w-full px-2 py-1" required>
                                    </td>
                                    <td class="p-2 text-center">
                                        <button type="button" @click="rows.splice(index, 1)" class="bg-red-500 text-white px-2 py-1 rounded">🗑️</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <div class="flex justify-between items-center mb-4">
                        <button type="button" @click="rows.push(rows.length)" class="bg-green-600 text-white px-3 py-1 rounded">+ Tambah Baris</button>
                        <div class="space-x-2">
                            <button type="button" @click="showModal = false" class="bg-gray-300 px-4 py-2 rounded">Batal</button>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data Tugas -->
    <table class="min-w-full table-auto border mt-6">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">Judul</th>
                <th class="px-4 py-2">Deskripsi</th>
                <th class="px-4 py-2">Mapel</th>
                <th class="px-4 py-2">Kelas</th>
                <th class="px-4 py-2">Deadline</th>
                <th class="px-4 py-2">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataTugas as $tugas)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $tugas->judul_tugas }}</td>
                <td class="px-4 py-2">{{ $tugas->deskripsi }}</td>
                <td class="px-4 py-2">{{ $tugas->mapel }}</td>
                <td class="px-4 py-2">{{ $tugas->kelas }}</td>
                <td class="px-4 py-2">{{ $tugas->tanggal_deadline }}</td>
                <td class="px-4 py-2 space-x-2">
                    <a href="/admin/tugas/edit/{{ $tugas->id_tugas }}" class="bg-blue-600 text-white px-3 py-1 rounded">✏️</a>
                    <form action="/admin/tugas/hapus/{{ $tugas->id_tugas }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Yakin ingin menghapus tugas ini?')">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
