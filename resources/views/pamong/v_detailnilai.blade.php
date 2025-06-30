@extends('pamong.templatepamong')

@section('content')
<div class="container mt-4">
    <h2 class="text-xl font-semibold mb-4">Detail Nilai Tugas</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full table-auto border bg-white">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Nama Siswa</th>
                <th class="p-2 border">Tanggal Pengumpulan</th>
                <th class="p-2 border">File</th>
                <th class="p-2 border">Nilai</th>
                <th class="p-2 border">Komentar</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
            <tr class="border-t">
                <td class="p-2 border">{{ $item->nama }}</td>
                <td class="p-2 border">{{ \Carbon\Carbon::parse($item->tanggal_pengumpulan)->format('d-m-Y H:i') }}</td>
                <td class="p-2 border">
                    <a href="{{ asset('pengumpulan/' . $item->file_pengumpulan) }}" target="_blank" class="text-blue-600 underline">
                        Lihat File
                    </a>
                </td>
                <form action="{{ route('pamong.nilai.simpan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_tugas" value="{{ $item->id_tugas }}">
                    <input type="hidden" name="id_siswa" value="{{ $item->id_siswa }}">
                    <td class="p-2 border">
                        <input type="number" name="nilai" class="border rounded px-2 py-1 w-20"
                               value="{{ $item->nilai ?? '' }}" min="0" max="100" required>
                    </td>
                    <td class="p-2 border">
                        <input type="text" name="komentar" class="border rounded px-2 py-1 w-full"
                               value="{{ $item->komentar ?? '' }}">
                    </td>
                    <td class="p-2 border">
                        <button type="submit"
                            class="px-3 py-1 rounded text-white {{ $item->nilai ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-blue-500 hover:bg-blue-600' }}">
                            {{ $item->nilai ? 'Edit' : 'Simpan' }}
                        </button>
                    </td>
                </form>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-gray-500 p-4 italic">Belum ada pengumpulan tugas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
