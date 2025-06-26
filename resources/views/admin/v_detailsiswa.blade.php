@extends('admin.templateadmin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Detail Siswa</h1>

<div class="bg-white rounded shadow p-6">
    <a href="{{ route('siswa.index') }}" class="mb-6 inline-block bg-gray-300 text-black px-4 py-2 rounded">
        ← Kembali
    </a>

    {{-- Data Pribadi --}}
    <h2 class="text-lg font-semibold mb-4 border-b pb-1">Data Pribadi</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm mb-6">
        <div><strong>NISN:</strong> {{ $siswa->nisn ?? '-' }}</div>
        <div><strong>Nama Lengkap:</strong> {{ $siswa->nama_lengkap }}</div>
        <div><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin }}</div>
        <div><strong>Tempat Lahir:</strong> {{ $siswa->tempat_lahir }}</div>
        <div><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</div>
        <div><strong>Agama:</strong> {{ $siswa->agama }}</div>
        <div><strong>Alamat:</strong> {{ $siswa->alamat }}</div>
        <div><strong>Desa:</strong> {{ $siswa->desa }}</div>
        <div><strong>Kecamatan:</strong> {{ $siswa->kecamatan }}</div>
        <div><strong>Kabupaten:</strong> {{ $siswa->kabupaten }}</div>
        <div><strong>Provinsi:</strong> {{ $siswa->provinsi }}</div>
        <div><strong>No HP:</strong> {{ $siswa->no_hp }}</div>
        <div><strong>Email:</strong> {{ $siswa->email }}</div>
    </div>

    {{-- Data Orang Tua --}}
    <h2 class="text-lg font-semibold mb-4 border-b pb-1">Data Orang Tua</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm mb-6">
        <div><strong>Nama Ayah/Wali:</strong> {{ $siswa->nama_ayah_wali }}</div>
        <div><strong>NIK Ayah/Wali:</strong> {{ $siswa->nik_ayah_wali }}</div>
        <div><strong>Tahun Lahir Ayah/Wali:</strong> {{ $siswa->tahun_lahir_ayah_wali }}</div>
        <div><strong>Pekerjaan Ayah/Wali:</strong> {{ $siswa->pekerjaan_ayah_wali }}</div>
        <div><strong>Penghasilan Ayah/Wali:</strong> {{ $siswa->penghasilan_ayah_wali }}</div>

        <div><strong>Nama Ibu:</strong> {{ $siswa->nama_ibu }}</div>
        <div><strong>NIK Ibu:</strong> {{ $siswa->nik_ibu }}</div>
        <div><strong>Tahun Lahir Ibu:</strong> {{ $siswa->tahun_lahir_ibu }}</div>
        <div><strong>Pekerjaan Ibu:</strong> {{ $siswa->pekerjaan_ibu }}</div>
        <div><strong>Penghasilan Ibu:</strong> {{ $siswa->penghasilan_ibu }}</div>
    </div>

    {{-- Data Lain-lain --}}
    <h2 class="text-lg font-semibold mb-4 border-b pb-1">Data Lain-lain</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
        <div><strong>Tinggi Badan:</strong> {{ $siswa->tinggi_badan }} cm</div>
        <div><strong>Berat Badan:</strong> {{ $siswa->berat_badan }} kg</div>
        <div><strong>Jarak ke SKB:</strong> {{ $siswa->jarak_ke_skb }}</div>
        <div><strong>Waktu Tempuh ke SKB:</strong> {{ $siswa->waktu_tempuh_ke_skb }}</div>
        <div><strong>Anak Ke:</strong> {{ $siswa->anak_ke }}</div>
        <div><strong>Jumlah Saudara:</strong> {{ $siswa->jumlah_saudara }}</div>
        <div class="md:col-span-2"><strong>Prestasi:</strong> {{ $siswa->prestasi }}</div>
        <div><strong>Kelas:</strong> {{ $siswa->kelas }}</div>
        <div><strong>Paket:</strong> {{ $siswa->paket }}</div>
    </div>
</div>
@endsection
