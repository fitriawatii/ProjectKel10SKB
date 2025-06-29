<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class C_Tpesertadidik extends Controller
{
    public function dashboard()
{
    $id_akun = session('user')->id_akun;
    $siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->first();

    if (!$siswa) {
        return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
    }

    $id_siswa = $siswa->id_siswa;
    $id_kelas = $siswa->id_kelas;

    $tahunAjaranAktif = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();

    $totalTugas = DB::table('tb_tugas')
        ->where('id_kelas', $id_kelas)
        ->where('id_tahun_ajaran', $tahunAjaranAktif->id_tahun_ajaran)
        ->count();

    $totalPengumpulan = DB::table('tb_pengumpulan_tugas')
        ->where('id_siswa', $id_siswa)
        ->count();

    $rataRataNilai = DB::table('tb_nilai')
        ->where('id_siswa', $id_siswa)
        ->avg('nilai');

    $mingguSaatIni = now()->weekOfMonth; // ambil minggu aktif dari tanggal saat ini

    $jadwalMingguIni = DB::table('tb_jadwal')
        ->join('tb_kelas', 'tb_jadwal.id_kelas', '=', 'tb_kelas.id_kelas')
        ->join('tb_mapel', 'tb_jadwal.id_mapel', '=', 'tb_mapel.id_mapel')
        ->join('tb_pamong', 'tb_jadwal.id_pamong', '=', 'tb_pamong.id_pamong')
        ->select(
            'tb_jadwal.*',
            'tb_kelas.nama_kelas as nama_kelas',
            'tb_mapel.nama_mapel as nama_mapel',
            'tb_pamong.nama_pamong as nama_pamong'
        )
        ->where('tb_jadwal.id_kelas', $id_kelas)
        ->where('tb_jadwal.id_tahun_ajaran', $tahunAjaranAktif->id_tahun_ajaran)
        ->where('tb_jadwal.minggu_ke', $mingguSaatIni)
        ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
        ->orderBy('jam_mulai')
        ->get();

    return view('pesertadidik.v_dashboard', [
        'totalTugas' => $totalTugas,
        'totalPengumpulan' => $totalPengumpulan,
        'rataRataNilai' => round($rataRataNilai, 2),
        'jadwalMingguIni' => $jadwalMingguIni
    ]);
}


    public function lihatJadwal()
    {
        $id_akun = session('user')->id_akun;
        $id_kelas = DB::table('tb_siswa')->where('id_akun', $id_akun)->value('id_kelas');

        $tahunAjaranAktif = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();

        $jadwal = DB::table('tb_jadwal')
            ->where('tb_jadwal.id_kelas', $id_kelas)
            ->where('id_tahun_ajaran', $tahunAjaranAktif->id_tahun_ajaran)
            ->join('tb_mapel', 'tb_jadwal.id_mapel', '=', 'tb_mapel.id_mapel')
            ->join('tb_pamong', 'tb_jadwal.id_pamong', '=', 'tb_pamong.id_pamong')
            ->select('tb_jadwal.*', 'tb_mapel.nama_mapel', 'tb_pamong.nama_pamong')
            ->get();

        $events = [];
        foreach ($jadwal as $item) {
            $dayMap = [
                'Senin' => '2024-06-17',
                'Selasa' => '2024-06-18',
                'Rabu' => '2024-06-19',
                'Kamis' => '2024-06-20',
                'Jumat' => '2024-06-21',
                'Sabtu' => '2024-06-22',
                'Minggu' => '2024-06-23',
            ];
            $tanggalDummy = $dayMap[$item->hari] ?? now()->toDateString();
            $events[] = [
                'title' => $item->nama_mapel . ' - ' . $item->nama_pamong,
                'start' => $tanggalDummy . 'T' . $item->jam_mulai,
                'end'   => $tanggalDummy . 'T' . $item->jam_selesai,
            ];
        }

        return view('pesertadidik.v_jadwalpesertadidik', compact('events'));
    }

    public function index()
    {
        $user = Session::get('user');
        return view('pesertadidik.v_pesertadidik', compact('user'));
    }

    public function materi()
    {
        $id_akun = session('user')->id_akun ?? null;
        $siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $id_kelas = $siswa->id_kelas;
        $tahunAjaranAktif = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();

        $data = DB::table('tb_materi')
            ->join('tb_mapel', 'tb_materi.id_mapel', '=', 'tb_mapel.id_mapel')
            ->join('tb_kelas', 'tb_materi.id_kelas', '=', 'tb_kelas.id_kelas')
            ->where('tb_materi.id_kelas', $id_kelas)
            ->where('tb_materi.id_tahun_ajaran', $tahunAjaranAktif->id_tahun_ajaran)
            ->select('tb_materi.*', 'tb_mapel.nama_mapel as nama_mapel', 'tb_kelas.nama_kelas as kelas')
            ->orderBy('tb_materi.id_materi', 'desc')
            ->get();

        return view('pesertadidik.v_materipesertadidik', ['dataMateri' => $data]);
    }

    public function pilihMapelTugas(Request $request)
{
    $id_akun = session('user')->id_akun;
    $siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->first();

    // Ambil semua tahun ajaran untuk dropdown
    $tahunAjaranList = DB::table('tb_tahun_ajaran')->orderBy('id_tahun_ajaran', 'desc')->get();

    // Tahun ajaran yang dipilih, default ke tahun aktif
    $selectedTahun = $request->id_tahun_ajaran ?? DB::table('tb_tahun_ajaran')->where('is_active', 1)->value('id_tahun_ajaran');

    // Ambil mapel berdasarkan kelas siswa dan tahun ajaran (dari jadwal)
    $mapelList = DB::table('tb_mapel')
        ->join('tb_jadwal', 'tb_mapel.id_mapel', '=', 'tb_jadwal.id_mapel')
        ->where('tb_jadwal.id_kelas', $siswa->id_kelas)
        ->where('tb_jadwal.id_tahun_ajaran', $selectedTahun)
        ->select('tb_mapel.id_mapel', 'tb_mapel.nama_mapel')
        ->distinct()
        ->get();

    return view('pesertadidik.v_pilihmapeltugas', compact('mapelList', 'tahunAjaranList', 'selectedTahun'));
}

public function tugasPerMapel($id_mapel)
{
    $id_akun = session('user')->id_akun ?? null;
    $siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->first();

    if (!$siswa) {
        return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
    }

    $id_siswa = $siswa->id_siswa;
    $id_kelas = $siswa->id_kelas;
    $tanggalDaftar = $siswa->tanggal_daftar;

    $tahunAjaranAktif = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();

    $dataTugas = DB::table('tb_tugas')
        ->join('tb_mapel', 'tb_tugas.id_mapel', '=', 'tb_mapel.id_mapel')
        ->where('tb_tugas.id_kelas', $id_kelas)
        ->where('tb_tugas.id_tahun_ajaran', $tahunAjaranAktif->id_tahun_ajaran)
        ->where('tb_tugas.id_mapel', $id_mapel)
        ->whereDate('tb_tugas.created_at', '>=', $tanggalDaftar) // ✅ filter utama
        ->leftJoin('tb_nilai', function ($join) use ($id_siswa) {
            $join->on('tb_tugas.id_tugas', '=', 'tb_nilai.id_tugas')
                 ->where('tb_nilai.id_siswa', '=', $id_siswa);
        })
        ->select('tb_tugas.*', 'tb_mapel.nama_mapel', 'tb_nilai.nilai', 'tb_nilai.komentar')
        ->orderBy('tb_tugas.tanggal_deadline', 'desc')
        ->get();

    $pengumpulan = DB::table('tb_pengumpulan_tugas')
        ->where('id_siswa', $id_siswa)
        ->get()
        ->keyBy('id_tugas');

    $tugasDikumpulkan = [];
    foreach ($pengumpulan as $p) {
        $tugasDikumpulkan[$p->id_tugas] = $p->file_pengumpulan;
    }

    return view('pesertadidik.v_tugaspermapel', [
        'dataTugas' => $dataTugas,
        'tugasDikumpulkan' => $tugasDikumpulkan
    ]);
}



public function kirimTugas(Request $request)
{
    $request->validate([
        'id_tugas' => 'required|exists:tb_tugas,id_tugas',
        'file_pengumpulan' => 'required|file|mimes:pdf,doc,docx,zip|max:2048',
    ]);

    $id_akun = session('user')->id_akun;
    $siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->first();

    if (!$siswa) {
        return back()->with('error', 'Akun belum terdaftar sebagai siswa.');
    }

    $file = $request->file('file_pengumpulan');
    $namaFile = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('jawaban'), $namaFile);

    $cek = DB::table('tb_pengumpulan_tugas')
        ->where('id_tugas', $request->id_tugas)
        ->where('id_siswa', $siswa->id_siswa)
        ->first();

    if ($cek) {
        DB::table('tb_pengumpulan_tugas')
            ->where('id_pengumpulan', $cek->id_pengumpulan)
            ->update([
                'file_pengumpulan' => $namaFile,
                'tanggal_pengumpulan' => now(),
                'updated_at' => now(),
            ]);
    } else {
        DB::table('tb_pengumpulan_tugas')->insert([
            'id_tugas' => $request->id_tugas,
            'id_siswa' => $siswa->id_siswa,
            'file_pengumpulan' => $namaFile,
            'tanggal_pengumpulan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return back()->with('success', 'Tugas berhasil dikumpulkan.');
}

public function daftarTugas()
{
    $id_akun = session('user')['id_akun'];
    $id_siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->value('id_siswa');

    $dataTugas = DB::table('tb_tugas')->get();

    $tugasDikumpulkan = DB::table('tb_pengumpulan_tugas')
        ->where('id_siswa', $id_siswa)
        ->get()
        ->keyBy('id_tugas');

    return view('pesertadidik.v_tugas', compact('dataTugas', 'tugasDikumpulkan'));
}

    // Ujian untuk peserta didik
    public function ujian()
    {
        $nis = Session::get('user')['id_akun'];

        $kelas = DB::table('tb_siswa')
                    ->where('nis', $nis)
                    ->value('id_kelas');

        $ujian = DB::table('tb_ujian')
            ->join('tb_mapel', 'tb_ujian.id_mapel', '=', 'tb_mapel.id_mapel')
            ->where('tb_ujian.id_kelas', $kelas)
            ->select('tb_ujian.*', 'tb_mapel.mapel')
            ->get();

        return view('pesertadidik.v_ujianpesertadidik', compact('ujian'));
    }
   public function daftarMapel(Request $request)
{
    $id_akun = session('user')->id_akun;

    $siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->first();

    $tahunAjaranList = DB::table('tb_tahun_ajaran')->get();
    $selectedTahun = $request->id_tahun_ajaran ?? DB::table('tb_tahun_ajaran')->where('is_active', 1)->value('id_tahun_ajaran');

    $mapelList = DB::table('tb_mapel')
        ->join('tb_materi', 'tb_mapel.id_mapel', '=', 'tb_materi.id_mapel')
        ->where('tb_materi.id_kelas', $siswa->id_kelas)
        ->where('tb_materi.id_tahun_ajaran', $selectedTahun)
        ->select('tb_mapel.id_mapel', 'tb_mapel.nama_mapel')
        ->distinct()
        ->get();

    return view('pesertadidik.v_pilihmapelmateri', compact('mapelList', 'tahunAjaranList', 'selectedTahun'));
}

public function materiPerMapel($id_mapel, Request $request)
{
    $id_akun = session('user')->id_akun;
    $siswa = DB::table('tb_siswa')->where('id_akun', $id_akun)->first();

    if (!$siswa) {
        return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
    }

    $selectedTahun = $request->id_tahun_ajaran ?? DB::table('tb_tahun_ajaran')
        ->where('is_active', 1)
        ->value('id_tahun_ajaran');

    $materiList = DB::table('tb_materi')
        ->where('id_kelas', $siswa->id_kelas)
        ->where('id_mapel', $id_mapel)
        ->where('id_tahun_ajaran', $selectedTahun)
        ->where('created_at', '>=', $siswa->tanggal_daftar) // batas akses berdasarkan tanggal daftar
        ->get();

    return view('pesertadidik.v_materi', compact('materiList'));
}


}