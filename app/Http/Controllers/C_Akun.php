<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class C_Akun extends Controller
{
    public function index(Request $request)
{
    $query = DB::table('tb_akun');

    if ($request->filled('cari')) {
        $search = $request->cari;
        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('role', 'like', "%$search%");
        });
    }

    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    $akun = $query->get();

    return view('admin.v_akun', compact('akun'));
}



    public function formTambah()
    {
        return view('admin.v_tambahakun');
    }
public function simpan(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:tb_akun,email',
        'password' => 'required|min:6',
        'role' => 'required',
    ]);

    // 1. Simpan akun baru
    $id_akun = DB::table('tb_akun')->insertGetId([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    // 2. Jika role peserta didik, cari siswa berdasarkan nama dan id_akun masih NULL
    if ($request->role === 'peserta_didik') {
        DB::table('tb_siswa')
            ->where('nama_lengkap', $request->nama)
            ->whereNull('id_akun')
            ->update(['id_akun' => $id_akun]);
    }

    return redirect('/akun')->with('success', 'Akun berhasil ditambahkan.');
}



public function hapus($id_akun)
{
    // Hapus data dari tabel tb_akun berdasarkan ID
    DB::table('tb_akun')->where('id_akun', $id_akun)->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Akun berhasil dihapus.');
}

public function formGantiAkun()
{
    $user = session('user');
    return view('akun.v_gantiakun', compact('user'));
}

public function profil()
{
    $user = session('user');
    return view('akun.v_profile', compact('user'));
}

public function updateProfil(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'nullable|min:6|confirmed',
    ]);

    $data = [
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    DB::table('tb_akun')->where('id_akun', session('user')->id_akun)->update($data);

    // Update session juga agar email langsung terlihat saat reload
    session()->put('user', (object) array_merge((array) session('user'), $data));

    return back()->with('success', 'Profil berhasil diperbarui.');
}

public function updateAkun(Request $request)
{
    $id_akun = session('user')->id_akun;

    $request->validate([
        'email' => 'required|email|unique:tb_akun,email,' . $id_akun . ',id_akun',
        'password' => 'nullable|min:6|confirmed', // password & password_confirmation
    ]);

    $data = ['email' => $request->email];

    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    DB::table('tb_akun')->where('id_akun', $id_akun)->update($data);

    return redirect()->back()->with('success', 'Akun berhasil diperbarui.');
}

}
