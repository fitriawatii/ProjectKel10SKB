@extends('admin.templateadmin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Data Kelas</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama Kelas</th>
                    <th class="border px-4 py-2">Nama Paket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datakelas as $index => $kelas)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $kelas->nama_kelas }}</td>
                    <td class="border px-4 py-2">{{ $kelas->nama_paket }}</td>
                </tr>
                @endforeach

                @if($datakelas->isEmpty())
                <tr>
                    <td colspan="3" class="text-center py-4">Data kelas tidak tersedia.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
