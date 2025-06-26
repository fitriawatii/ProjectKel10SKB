<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login'); // tampilkan form login
    }

    public function login(Request $request)
    {
        $akun = DB::table('tb_akun')->where('email', $request->email)->first();

        if ($akun && Hash::check($request->password, $akun->password)) {
            // Simpan data akun ke session
            Session::put('user', [
                'id_akun' => $akun->id_akun,
                'nama' => $akun->nama,
                'role' => $akun->role
            ]);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }

    public function dashboard()
    {
        if (!Session::has('user')) {
            return redirect('/login');
        }

        return view('dashboard', ['user' => Session::get('user')]);
    }
}
