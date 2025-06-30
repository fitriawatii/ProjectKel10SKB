<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_nilai extends Controller
{
    public function index(Request $request)
{
    $id_akun = session('user')->id_akun;

    // Ambil pamong
    $pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->first();

    // Tahun ajaran aktif atau yang dipilih
    $selectedTahun = $request->id_tahun_ajaran ?? DB::table('tb_tahun_ajaran')
        ->where('is_active', 1)->value('id_tahun_ajaran');

    // Ambil semua tahun ajaran
    $tahunAjaranList = DB::table('tb_tahun_ajaran')->get();

    // Ambil tugas yang dikumpulkan + nilai
    $data = DB::table('tb_pengumpulan_tugas')
        ->join('tb_siswa', 'tb_pengumpulan_tugas.id_siswa', '=', 'tb_siswa.id_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->join('tb_tugas', 'tb_pengumpulan_tugas.id_tugas', '=', 'tb_tugas.id_tugas')
        ->leftJoin('tb_nilai', function ($join) {
            $join->on('tb_pengumpulan_tugas.id_tugas', '=', 'tb_nilai.id_tugas')
                 ->on('tb_pengumpulan_tugas.id_siswa', '=', 'tb_nilai.id_siswa');
        })
        ->where('tb_tugas.id_tahun_ajaran', $selectedTahun)
        ->select(
            'tb_pengumpulan_tugas.*',
            'tb_siswa.nama_lengkap',
            'tb_kelas.nama_kelas',
            'tb_tugas.judul_tugas',
            'tb_tugas.tanggal_deadline',
            'tb_nilai.nilai',
            'tb_nilai.komentar'
        )
        ->orderBy('tb_pengumpulan_tugas.tanggal_pengumpulan', 'desc')
        ->get();

    return view('pamong.v_nilai', compact('data', 'tahunAjaranList', 'selectedTahun'));
}



    public function simpan(Request $request)
    {
        $request->validate([
            'id_tugas' => 'required|integer',
            'id_siswa' => 'required|integer',
            'nilai' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string|max:255',
        ]);

        // Ambil tahun ajaran aktif
        $tahunAjaran = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();
        $id_tahun_ajaran = $tahunAjaran ? $tahunAjaran->id_tahun_ajaran : null;

        $cek = DB::table('tb_nilai')->where([
            ['id_tugas', '=', $request->id_tugas],
            ['id_siswa', '=', $request->id_siswa],
            ['id_tahun_ajaran', '=', $id_tahun_ajaran],
        ])->first();

        if ($cek) {
            // Update nilai jika sudah ada
            DB::table('tb_nilai')->where('id_nilai', $cek->id_nilai)->update([
                'nilai' => $request->nilai,
                'komentar' => $request->komentar,
                'updated_at' => now(),
            ]);
        } else {
            // Simpan nilai baru
            DB::table('tb_nilai')->insert([
                'id_tugas' => $request->id_tugas,
                'id_siswa' => $request->id_siswa,
                'id_tahun_ajaran' => $id_tahun_ajaran,
                'nilai' => $request->nilai,
                'komentar' => $request->komentar,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }
}
