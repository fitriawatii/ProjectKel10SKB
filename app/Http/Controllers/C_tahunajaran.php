<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_tahunajaran extends Controller
{
    // Tampilkan daftar tahun ajaran
    public function index()
    {
        $dataTahun = DB::table('tb_tahun_ajaran')->orderByDesc('id_tahun_ajaran')->get();
        return view('admin.v_tahunajaran', compact('dataTahun'));
    }

    // Simpan tahun ajaran baru
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|unique:tb_tahun_ajaran,tahun_ajaran',
        ]);

        DB::table('tb_tahun_ajaran')->insert([
            'tahun_ajaran' => $request->tahun_ajaran,
            'is_active' => 0
        ]);

        return redirect()->back()->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    // Set salah satu tahun ajaran sebagai aktif
    public function setAktif($id)
    {
        // Reset semua ke tidak aktif
        DB::table('tb_tahun_ajaran')->update(['is_active' => 0]);

        // Set yang dipilih menjadi aktif
        DB::table('tb_tahun_ajaran')->where('id_tahun_ajaran', $id)->update(['is_active' => 1]);

        return redirect()->back()->with('success', 'Tahun ajaran berhasil diaktifkan.');
    }

    // Hapus tahun ajaran
    public function destroy($id)
    {
        DB::table('tb_tahun_ajaran')->where('id_tahun_ajaran', $id)->delete();
        return redirect()->back()->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
