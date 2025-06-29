<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_FormulirProgram;
use Illuminate\Support\Facades\DB;

class C_kelolaformulirprogram extends Controller
{
    public function datapendaftar(Request $request)
{
    $keyword = $request->input('cari'); // ambil keyword pencarian dari form

    $dataPendaftar = DB::table('tb_pendaftaran_program')
        ->leftJoin('tb_kelas', 'tb_pendaftaran_program.id_kelas', '=', 'tb_kelas.id_kelas')
        ->leftJoin('tb_paket', 'tb_pendaftaran_program.id_paket', '=', 'tb_paket.id_paket')
        ->select(
            'tb_pendaftaran_program.*',
            'tb_kelas.nama_kelas as kelas',
            'tb_paket.nama_paket as paket',
            'tb_pendaftaran_program.status'
        )
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('tb_pendaftaran_program.nama_lengkap', 'like', '%' . $keyword . '%')
                  ->orWhere('tb_pendaftaran_program.nisn', 'like', '%' . $keyword . '%')
                  ->orWhere('tb_pendaftaran_program.no_hp', 'like', '%' . $keyword . '%')
                  ->orWhere('tb_paket.nama_paket', 'like', '%' . $keyword . '%');
        })
        ->get();

    return view('masyarakat.v_datapendaftar', compact('dataPendaftar'));
}


   public function terimaPendaftar(Request $request, $id)
{
    // Ambil data pendaftar
    $pendaftar = DB::table('tb_pendaftaran_program')->where('id_pendaftaran', $id)->first();

    if (!$pendaftar) {
        return redirect()->back()->with('error', 'Data pendaftar tidak ditemukan.');
    }

    // Cek apakah siswa dengan NISN tersebut sudah ada
    $sudahAda = DB::table('tb_siswa')->where('nisn', $pendaftar->nisn)->exists();
    if ($sudahAda) {
        return redirect()->back()->with('warning', 'Siswa dengan NISN ini sudah ada di tb_siswa.');
    }

    // INSERT ke tb_siswa (lengkap dengan tanggal_daftar)
    DB::table('tb_siswa')->insert([
        'nisn' => $pendaftar->nisn,
        'nama_lengkap' => $pendaftar->nama_lengkap,
        'jenis_kelamin' => $pendaftar->jenis_kelamin,
        'tempat_lahir' => $pendaftar->tempat_lahir,
        'tanggal_lahir' => $pendaftar->tanggal_lahir,
        'agama' => $pendaftar->agama,
        'alamat' => $pendaftar->alamat,
        'dusun' => $pendaftar->dusun,
        'desa' => $pendaftar->desa,
        'kecamatan' => $pendaftar->kecamatan,
        'kabupaten' => $pendaftar->kabupaten,
        'provinsi' => $pendaftar->provinsi,
        'no_hp' => $pendaftar->no_hp,
        'email' => $pendaftar->email,

        'nama_ayah_wali' => $pendaftar->nama_ayah_wali,
        'nik_ayah_wali' => $pendaftar->nik_ayah_wali,
        'tahun_lahir_ayah_wali' => $pendaftar->tahun_lahir_ayah_wali,
        'pekerjaan_ayah_wali' => $pendaftar->pekerjaan_ayah_wali,
        'penghasilan_ayah_wali' => $pendaftar->penghasilan_ayah_wali,

        'nama_ibu' => $pendaftar->nama_ibu,
        'nik_ibu' => $pendaftar->nik_ibu,
        'tahun_lahir_ibu' => $pendaftar->tahun_lahir_ibu,
        'pekerjaan_ibu' => $pendaftar->pekerjaan_ibu,
        'penghasilan_ibu' => $pendaftar->penghasilan_ibu,

        'tinggi_badan' => $pendaftar->tinggi_badan,
        'berat_badan' => $pendaftar->berat_badan,
        'jarak_ke_skb' => $pendaftar->jarak_ke_skb,
        'waktu_tempuh_ke_skb' => $pendaftar->waktu_tempuh_ke_skb,
        'anak_ke' => $pendaftar->anak_ke,
        'jumlah_saudara' => $pendaftar->jumlah_saudara,
        'prestasi' => $pendaftar->prestasi,

        'id_kelas' => $pendaftar->id_kelas,
        'id_paket' => $pendaftar->id_paket,

        'tanggal_daftar' => now(), // Tambahkan tanggal saat siswa resmi terdaftar
    ]);

    // Update status pendaftar
    DB::table('tb_pendaftaran_program')->where('id_pendaftaran', $id)->update([
        'status' => 'diterima'
    ]);

    return redirect()->back()->with('success', 'Pendaftar berhasil diterima dan datanya dipindahkan ke Data Peserta Didik.');
}



    public function create()
    {
        $dataKelas = DB::table('tb_kelas')->get();
        $dataPaket = DB::table('tb_paket')->get();

        return view('masyarakat.v_formprogramskb', [
            'dataKelas' => $dataKelas,
            'dataPaket' => $dataPaket
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nisn' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'dusun' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',

            'nama_ayah' => 'nullable|string|max:100',
            'nik_ayah' => 'nullable|string|max:20',
            'tahun_lahir_ayah' => 'nullable|string|max:4',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'penghasilan_ayah' => 'nullable|string|max:100',

            'nama_ibu' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|max:20',
            'tahun_lahir_ibu' => 'nullable|string|max:4',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'penghasilan_ibu' => 'nullable|string|max:100',

            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'jarak_ke_skb' => 'nullable|string|max:50',
            'waktu_tempuh' => 'nullable|string|max:50',
            'anak_ke' => 'nullable|integer',
            'jumlah_saudara' => 'nullable|integer',
            'prestasi' => 'nullable|string',

            'paket' => 'required|string',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
        ]);

        M_FormulirProgram::create([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'dusun' => $request->dusun,
            'desa' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'no_hp' => $request->no_hp,
            'email' => $request->email,

            'nama_ayah_wali' => $request->nama_ayah,
            'nik_ayah_wali' => $request->nik_ayah,
            'tahun_lahir_ayah_wali' => $request->tahun_lahir_ayah,
            'pekerjaan_ayah_wali' => $request->pekerjaan_ayah,
            'penghasilan_ayah_wali' => $request->penghasilan_ayah,

            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'tahun_lahir_ibu' => $request->tahun_lahir_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,

            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'jarak_ke_skb' => $request->jarak_ke_skb,
            'waktu_tempuh_ke_skb' => $request->waktu_tempuh,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'prestasi' => $request->prestasi,
            'id_kelas' => $request->id_kelas,
            'id_paket' => $request->paket,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil disimpan.');
    }
}
