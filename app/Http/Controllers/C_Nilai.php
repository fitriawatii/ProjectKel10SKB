<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_nilai extends Controller
{
    public function index()
{
    $id_akun = session('user')->id_akun;

    // Ambil id_pamong yang sedang login
    $id_pamong = DB::table('tb_pamong')
        ->where('id_akun', $id_akun)
        ->value('id_pamong');

    // Ambil tahun ajaran aktif
    $tahunAjaran = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();
    $id_tahun_ajaran = $tahunAjaran ? $tahunAjaran->id_tahun_ajaran : null;

    // Query data pengumpulan tugas untuk tugas yang dibuat pamong ini dan tahun ajaran aktif
    $data = DB::table('tb_pengumpulan_tugas')
        ->join('tb_tugas', function ($join) use ($id_pamong, $id_tahun_ajaran) {
            $join->on('tb_pengumpulan_tugas.id_tugas', '=', 'tb_tugas.id_tugas')
                 ->where('tb_tugas.id_pamong', '=', $id_pamong);

            if ($id_tahun_ajaran) {
                $join->where('tb_tugas.id_tahun_ajaran', '=', $id_tahun_ajaran);
            }
        })
        ->join('tb_siswa', 'tb_pengumpulan_tugas.id_siswa', '=', 'tb_siswa.id_siswa')
        ->leftJoin('tb_nilai', function ($join) use ($id_tahun_ajaran) {
            $join->on('tb_pengumpulan_tugas.id_tugas', '=', 'tb_nilai.id_tugas')
                 ->on('tb_pengumpulan_tugas.id_siswa', '=', 'tb_nilai.id_siswa');

            if ($id_tahun_ajaran) {
                $join->where('tb_nilai.id_tahun_ajaran', '=', $id_tahun_ajaran);
            }
        })
        ->select(
            'tb_pengumpulan_tugas.id_pengumpulan',
            'tb_pengumpulan_tugas.id_siswa',
            'tb_siswa.nama_lengkap',
            'tb_pengumpulan_tugas.id_tugas',
            'tb_pengumpulan_tugas.file_pengumpulan',
            'tb_pengumpulan_tugas.tanggal_pengumpulan',
            'tb_tugas.judul_tugas',
            'tb_tugas.tanggal_deadline',
            'tb_nilai.nilai',
            'tb_nilai.komentar'
        )
        ->orderBy('tb_pengumpulan_tugas.tanggal_pengumpulan', 'desc')
        ->get();

    return view('pamong.v_nilai', compact('data'));
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
