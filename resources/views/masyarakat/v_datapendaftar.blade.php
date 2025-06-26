@extends('admin.templateadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Data Pendaftar Program</h1>

    {{-- Form Pencarian --}}
    <form action="{{ route('datapendaftar') }}" method="GET" class="mb-4 flex">
        <input type="text" name="cari" value="{{ request('cari') }}"
               placeholder="Cari nama/NISN/paket..." 
               class="border px-4 py-2 rounded-l w-64 focus:outline-none focus:ring">
        <button type="submit" class="bg-blue-600 text-white px-4 rounded-r hover:bg-blue-700">Cari</button>
    </form>

    {{-- Tabel Data Pendaftar --}}
    <div class="bg-white rounded shadow p-4 overflow-x-auto">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">NISN</th>
                    <th class="px-4 py-2 border">Jenis Kelamin</th>
                    <th class="px-4 py-2 border">Kelas</th>
                    <th class="px-4 py-2 border">Paket</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dataPendaftar as $index => $item)
                    <tr class="border-t">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $item->nama_lengkap }}</td>
                        <td class="px-4 py-2 border">{{ $item->nisn ?? '-' }}</td>
                        <td class="px-4 py-2 border">{{ $item->jenis_kelamin }}</td>
                        <td class="px-4 py-2 border">{{ $item->kelas }}</td>
                        <td class="px-4 py-2 border">{{ $item->paket }}</td>
                        <td class="px-4 py-2 border font-semibold {{ $item->status == 'diterima' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ ucfirst($item->status) }}
                        </td>
                        <td class="px-4 py-2 border">
                            @if($item->status != 'diterima')
                                <form action="{{ route('terima.pendaftar', $item->id_pendaftaran) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                        Terima
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-500 italic">✔ Sudah diterima</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-4 text-center text-gray-500 italic">Tidak ada data pendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
