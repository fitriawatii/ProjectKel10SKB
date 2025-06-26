@extends('layout.v_template_formprogramskb')

@section('content')
<div class="container my-4">
    <h2 class="mb-4 text-center">Formulir Pendaftaran Program SKB</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('formulirprogram.store') }}">
        @csrf

        {{-- === DATA DIRI === --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Data Diri</div>
            <div class="card-body">
                <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required></div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3"><label>NISN</label><input type="text" name="nisn" class="form-control" required></div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3"><label>NIK</label><input type="text" name="nik" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label>Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" required></div>
                </div>

                <div class="mb-3"><label>Agama</label><input type="text" name="agama" class="form-control" required></div>
                <div class="mb-3"><label>Alamat Lengkap</label><textarea name="alamat" class="form-control" required></textarea></div>

                <div class="row">
                    <div class="col-md-6 mb-3"><label>Dusun</label><input type="text" name="dusun" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label>Desa</label><input type="text" name="desa" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label>Kecamatan</label><input type="text" name="kecamatan" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label>Kabupaten</label><input type="text" name="kabupaten" class="form-control" required></div>
                    <div class="col-md-6 mb-3"><label>Provinsi</label><input type="text" name="provinsi" class="form-control" required></div>
                </div>

                <div class="mb-3"><label>No HP/WA</label><input type="text" name="no_hp" class="form-control" required></div>
                <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
            </div>
        </div>

        {{-- === DATA ORANG TUA === --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Data Ayah/Wali</div>
            <div class="card-body row">
                <div class="col-md-6 mb-3"><label>Nama Ayah/Wali</label><input type="text" name="nama_ayah" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>NIK Ayah/Wali</label><input type="text" name="nik_ayah" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Tahun Lahir Ayah/Wali</label><input type="number" name="tahun_lahir_ayah" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Pekerjaan Ayah/Wali</label><input type="text" name="pekerjaan_ayah" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Penghasilan Ayah/Wali</label><input type="text" name="penghasilan_ayah" class="form-control" required></div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Data Ibu</div>
            <div class="card-body row">
                <div class="col-md-6 mb-3"><label>Nama Ibu</label><input type="text" name="nama_ibu" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>NIK Ibu</label><input type="text" name="nik_ibu" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Tahun Lahir Ibu</label><input type="number" name="tahun_lahir_ibu" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Pekerjaan Ibu</label><input type="text" name="pekerjaan_ibu" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Penghasilan Ibu</label><input type="text" name="penghasilan_ibu" class="form-control" required></div>
            </div>
        </div>

        {{-- === DATA TAMBAHAN === --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Data Tambahan</div>
            <div class="card-body row">
                <div class="col-md-6 mb-3"><label>Tinggi Badan</label><input type="text" name="tinggi_badan" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Berat Badan</label><input type="text" name="berat_badan" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Jarak ke SKB</label><input type="text" name="jarak_ke_skb" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Waktu Tempuh ke SKB</label><input type="text" name="waktu_tempuh" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Anak ke-</label><input type="number" name="anak_ke" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label>Jumlah Saudara</label><input type="number" name="jumlah_saudara" class="form-control" required></div>

                <div class="col-md-12 mb-3"><label>Prestasi saat sekolah</label><textarea name="prestasi" class="form-control" rows="3" required></textarea></div>

                <div class="col-md-12 mb-3">
                    <label>Kelas yang dipilih</label>
                    <select name="id_kelas" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($dataKelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Paket yang dipilih</label>
                    <select name="paket" class="form-control" required>
                        <option value="">Pilih Paket</option>
                        @foreach($dataPaket as $p)
                            <option value="{{ $p->id_paket }}">{{ $p->nama_paket }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success px-4 py-2">Kirim Pendaftaran</button>
        </div>
    </form>
</div>
@endsection
