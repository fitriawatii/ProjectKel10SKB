<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_jadwal extends Controller
{
    public function index()
    {
        // Ambil tahun ajaran aktif
        $tahunAjaranAktif = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();

        $data = DB::table('tb_jadwal')
            ->join('tb_kelas', 'tb_jadwal.id_kelas', '=', 'tb_kelas.id_kelas')
            ->join('tb_mapel', 'tb_jadwal.id_mapel', '=', 'tb_mapel.id_mapel')
            ->join('tb_pamong', 'tb_jadwal.id_pamong', '=', 'tb_pamong.id_pamong')
            ->when($tahunAjaranAktif, function ($query) use ($tahunAjaranAktif) {
                return $query->where('tb_jadwal.id_tahun_ajaran', $tahunAjaranAktif->id_tahun_ajaran);
            })
            ->select('tb_jadwal.*', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel', 'tb_pamong.nama_pamong')
            ->get();

        return view('admin.v_tabeljadwal', compact('data'));
    }

    public function tambah()
    {
        $kelas = DB::table('tb_kelas')->get();
        $mapel = DB::table('tb_mapel')->get();
        $pamong = DB::table('tb_pamong')->get();
        return view('admin.v_tambahjadwal', compact('kelas', 'mapel', 'pamong'));
    }

    public function store(Request $request)
    {
        // Ambil tahun ajaran aktif
        $tahunAjaranAktif = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->back()->with('error', 'Tahun ajaran aktif tidak ditemukan.');
        }

        DB::table('tb_jadwal')->insert([
            'minggu_ke' => $request->minggu_ke,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'id_pamong' => $request->id_pamong,
            'id_tahun_ajaran' => $tahunAjaranAktif->id_tahun_ajaran,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = DB::table('tb_jadwal')->where('id_jadwal', $id)->first();
        $kelas = DB::table('tb_kelas')->get();
        $mapel = DB::table('tb_mapel')->get();
        $pamong = DB::table('tb_pamong')->get();
        return view('admin.v_editjadwal', compact('data', 'kelas', 'mapel', 'pamong'));
    }

    public function update(Request $request, $id)
    {
        // Ambil tahun ajaran aktif
        $tahunAjaranAktif = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();

        if (!$tahunAjaranAktif) {
            return redirect()->back()->with('error', 'Tahun ajaran aktif tidak ditemukan.');
        }

        DB::table('tb_jadwal')->where('id_jadwal', $id)->update([
            'minggu_ke' => $request->minggu_ke,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'id_kelas' => $request->id_kelas,
            'id_mapel' => $request->id_mapel,
            'id_pamong' => $request->id_pamong,
            'id_tahun_ajaran' => $tahunAjaranAktif->id_tahun_ajaran,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('tb_jadwal')->where('id_jadwal', $id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
