<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class C_Auth extends Controller
{
    // Tampilkan form login
    public function loginForm()
    {
        return view('v_login');
    }

    // Proses login dari tb_akun
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Cari akun berdasarkan email
    $akun = DB::table('tb_akun')->where('email', $request->email)->first();

    if ($akun && Hash::check($request->password, $akun->password)) {
        // Simpan data ke session
        session(['user' => $akun]);

        // Redirect sesuai role
        if ($akun->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($akun->role == 'pamong') {
            return redirect('/pamong/dashboard');
        } elseif ($akun->role == 'peserta_didik') {
            return redirect('/pesertadidik/dashboard');
        }
    }

    return redirect()->back()->with('error', 'Email atau password salah.');
}


    // Logout
    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }

    // Dashboard (proteksi manual)
    public function dashboardAdmin()
{
    if (!Session::has('user')) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $user = Session::get('user');

    $jumlahPamong = DB::table('tb_pamong')->count();
    $jumlahSiswa = DB::table('tb_siswa')->count();
    $jumlahKelas = DB::table('tb_kelas')->count();
    $jumlahMapel = DB::table('tb_mapel')->count();

    return view('admin.v_dashboard', compact('user', 'jumlahPamong', 'jumlahSiswa', 'jumlahKelas', 'jumlahMapel'));
}

// Untuk Pamong
public function dashboardPamong()
{
    if (!Session::has('user')) {
        return redirect('/login');
    }

    $jumlahSiswa = DB::table('tb_siswa')->count();
    $jumlahTugas = DB::table('tb_tugas')->count();
    $jumlahMateri = DB::table('tb_materi')->count();

    return view('pamong.v_dashboard', compact('jumlahSiswa', 'jumlahTugas', 'jumlahMateri'));
}

// Untuk Siswa
public function dashboardSiswa()
{
    if (!Session::has('user')) {
        return redirect('/login');
    }

    $nis = Session::get('user')->id_akun;
    $siswa = DB::table('tb_siswa')->where('nis', $nis)->first();

    return view('pesertadidik.v_dashboard', compact('siswa'));
}


}
