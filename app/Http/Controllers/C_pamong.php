<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\M_pamong;
use Carbon\Carbon;

class C_pamong extends Controller
{
    public function __construct()
    {
        $this->M_pamong = new M_pamong();
    }

    public function dashboard()
    {
        $id_akun = session('user')->id_akun;
        $pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->first();

        if (!$pamong) {
            return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
        }

        $id_pamong = $pamong->id_pamong;

        $jumlahTugas = DB::table('tb_tugas')
            ->join('tb_jadwal', function ($join) use ($id_pamong) {
                $join->on('tb_tugas.id_mapel', '=', 'tb_jadwal.id_mapel')
                     ->on('tb_tugas.id_kelas', '=', 'tb_jadwal.id_kelas')
                     ->where('tb_jadwal.id_pamong', $id_pamong);
            })
            ->count();

        $jumlahPengumpulan = DB::table('tb_pengumpulan_tugas')
            ->join('tb_tugas', 'tb_pengumpulan_tugas.id_tugas', '=', 'tb_tugas.id_tugas')
            ->join('tb_jadwal', function ($join) use ($id_pamong) {
                $join->on('tb_tugas.id_mapel', '=', 'tb_jadwal.id_mapel')
                     ->on('tb_tugas.id_kelas', '=', 'tb_jadwal.id_kelas')
                     ->where('tb_jadwal.id_pamong', $id_pamong);
            })
            ->count();

        $jumlahPeserta = DB::table('tb_siswa')->count();
        $mingguSaatIni = now()->weekOfMonth;

        $jadwalMingguIni = DB::table('tb_jadwal')
            ->where('id_pamong', $id_pamong)
            ->where('minggu_ke', $mingguSaatIni)
            ->join('tb_kelas', 'tb_jadwal.id_kelas', '=', 'tb_kelas.id_kelas')
            ->join('tb_mapel', 'tb_jadwal.id_mapel', '=', 'tb_mapel.id_mapel')
            ->select('tb_jadwal.*', 'tb_kelas.nama_kelas', 'tb_mapel.nama_mapel')
            ->orderBy('tb_jadwal.hari')
            ->get();

        return view('pamong.v_dashboard', compact('jumlahTugas', 'jumlahPengumpulan', 'jumlahPeserta', 'jadwalMingguIni'));
    }

   public function indexmateri(Request $request)
{
    $id_akun = session('user')->id_akun;

    $pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->first();

    if (!$pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    $tahunAjaranList = DB::table('tb_tahun_ajaran')->orderBy('tahun_ajaran', 'desc')->get();
    $selectedTahun = $request->get('id_tahun_ajaran') ?? DB::table('tb_tahun_ajaran')->where('is_active', 1)->value('id_tahun_ajaran');

    $materi = DB::table('tb_materi')
        ->join('tb_mapel', 'tb_materi.id_mapel', '=', 'tb_mapel.id_mapel')
        ->join('tb_kelas', 'tb_materi.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_materi.id_mapel', $pamong->id_mapel)
        ->where('tb_materi.id_tahun_ajaran', $selectedTahun)
        ->select('tb_materi.*', 'tb_mapel.nama_mapel', 'tb_kelas.nama_kelas')
        ->get();

    return view('pamong.v_tabelmateri', compact('materi', 'tahunAjaranList', 'selectedTahun'));
}
public function materiByKelas(Request $request, $id_kelas)
{
    $id_akun = session('user')->id_akun;

    // Ambil id_pamong dari akun
    $id_pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->value('id_pamong');

    if (!$id_pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    // Cek apakah pamong memang mengajar kelas ini
    $isValid = DB::table('tb_pamong_kelas')
        ->where('id_pamong', $id_pamong)
        ->where('id_kelas', $id_kelas)
        ->exists();

    if (!$isValid) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kelas ini.');
    }

    // Ambil tahun ajaran aktif atau dari request
    $tahunAjaranList = DB::table('tb_tahun_ajaran')->orderBy('tahun_ajaran', 'desc')->get();
    $selectedTahun = $request->get('id_tahun_ajaran') ?? DB::table('tb_tahun_ajaran')->where('is_active', 1)->value('id_tahun_ajaran');

    // Ambil materi berdasarkan kelas dan tahun ajaran
    $materi = DB::table('tb_materi')
        ->join('tb_mapel', 'tb_materi.id_mapel', '=', 'tb_mapel.id_mapel')
        ->join('tb_kelas', 'tb_materi.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_materi.id_kelas', $id_kelas)
        ->where('tb_materi.id_tahun_ajaran', $selectedTahun)
        ->select('tb_materi.*', 'tb_mapel.nama_mapel', 'tb_kelas.nama_kelas')
        ->get();

    return view('pamong.v_tabelmateri', compact('materi', 'tahunAjaranList', 'selectedTahun', 'id_kelas'));
}

    public function indextugas(Request $request)
{
    $id_akun = session('user')->id_akun;

    $pamong = DB::table('tb_pamong')
        ->where('id_akun', $id_akun)
        ->select('id_pamong', 'id_mapel')
        ->first();

    if (!$pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    // Semua tahun ajaran untuk dropdown
    $tahunAjaranList = DB::table('tb_tahun_ajaran')->orderBy('tahun_ajaran', 'desc')->get();

    // Tahun ajaran terpilih (dari request atau default aktif)
    $selectedTahun = $request->input('id_tahun_ajaran') ?? DB::table('tb_tahun_ajaran')->where('is_active', 1)->value('id_tahun_ajaran');

    // Ambil tugas berdasarkan tahun ajaran terpilih
    $tugas = DB::table('tb_tugas')
        ->join('tb_mapel', 'tb_tugas.id_mapel', '=', 'tb_mapel.id_mapel')
        ->join('tb_kelas', 'tb_tugas.id_kelas', '=', 'tb_kelas.id_kelas')
        ->join('tb_tahun_ajaran', 'tb_tugas.id_tahun_ajaran', '=', 'tb_tahun_ajaran.id_tahun_ajaran')
        ->where('tb_tugas.id_mapel', $pamong->id_mapel)
        ->where('tb_tugas.id_tahun_ajaran', $selectedTahun)
        ->select('tb_tugas.*', 'tb_mapel.nama_mapel', 'tb_kelas.nama_kelas', 'tb_tahun_ajaran.tahun_ajaran')
        ->orderBy('tb_tugas.tanggal_deadline', 'desc')
        ->get();

    return view('pamong.v_tugas', compact('tugas', 'tahunAjaranList', 'selectedTahun'));
}

public function tugasByKelas(Request $request, $id_kelas)
{
    $id_akun = session('user')->id_akun;

    $id_pamong = DB::table('tb_pamong')
        ->where('id_akun', $id_akun)
        ->value('id_pamong');

    $isValid = DB::table('tb_pamong_kelas')
        ->where('id_pamong', $id_pamong)
        ->where('id_kelas', $id_kelas)
        ->exists();

    if (!$isValid) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kelas ini.');
    }

    $tahunAjaranList = DB::table('tb_tahun_ajaran')->orderBy('tahun_ajaran', 'desc')->get();
    $selectedTahun = $request->get('id_tahun_ajaran') ?? DB::table('tb_tahun_ajaran')->where('is_active', 1)->value('id_tahun_ajaran');

    $tugas = DB::table('tb_tugas')
        ->join('tb_mapel', 'tb_tugas.id_mapel', '=', 'tb_mapel.id_mapel')
        ->join('tb_kelas', 'tb_tugas.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_tugas.id_kelas', $id_kelas)
        ->where('tb_tugas.id_tahun_ajaran', $selectedTahun)
        ->select('tb_tugas.*', 'tb_mapel.nama_mapel', 'tb_kelas.nama_kelas')
        ->get();

    return view('pamong.v_tugas', compact('tugas', 'tahunAjaranList', 'selectedTahun', 'id_kelas'));
}


    public function formtambah() 
    {
        $id_akun = session('user')->id_akun;
        $pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->first();
        if (!$pamong) {
            return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
        }

        $id_pamong = $pamong->id_pamong;

        $mapel = DB::table('tb_mapel')
            ->join('tb_pamong', 'tb_mapel.id_mapel', '=', 'tb_pamong.id_mapel')
            ->where('tb_pamong.id_pamong', $id_pamong)
            ->select('tb_mapel.id_mapel', 'tb_mapel.nama_mapel')
            ->get();

        $kelas = DB::table('tb_pamong_kelas')
            ->join('tb_kelas', 'tb_pamong_kelas.id_kelas', '=', 'tb_kelas.id_kelas')
            ->where('tb_pamong_kelas.id_pamong', $id_pamong)
            ->select('tb_kelas.id_kelas', 'tb_kelas.nama_kelas')
            ->distinct()
            ->get();

        $dataMateri = DB::table('tb_materi')
            ->leftJoin('tb_kelas', 'tb_materi.id_kelas', '=', 'tb_kelas.id_kelas')
            ->leftJoin('tb_mapel', 'tb_materi.id_mapel', '=', 'tb_mapel.id_mapel')
            ->select('tb_materi.*', 'tb_mapel.nama_mapel', 'tb_kelas.nama_kelas')
            ->get();

        return view('pamong.v_tambahmateri', compact('kelas', 'mapel', 'dataMateri'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'judul_tugas' => 'required|string',
            'deskripsi' => 'required|string',
            'id_mapel' => 'required',
            'id_kelas' => 'required',
            'tanggal_deadline' => 'required|date',
            'file_tugas' => 'nullable|file|max:10240',
        ]);

        $id_akun = session('user')->id_akun;
        $id_pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->value('id_pamong');

        $fileName = null;
        if ($request->hasFile('file_tugas')) {
            $file = $request->file('file_tugas');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file_tugas'), $fileName);
        }

        $tahunAjaran = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();
        $id_tahun_ajaran = $tahunAjaran ? $tahunAjaran->id_tahun_ajaran : null;

        DB::table('tb_tugas')->insert([
            'judul_tugas' => $request->judul_tugas,
            'deskripsi' => $request->deskripsi,
            'id_mapel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'id_pamong' => $id_pamong,
            'tanggal_deadline' => $request->tanggal_deadline,
            'file_tugas' => $fileName,
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/pamong/tabeltugas')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function tambahmateri(Request $request)
    {
        $request->validate([
            'nama_materi' => 'required|string',
            'id_mapel' => 'required',
            'id_kelas' => 'required',
            'keterangan_materi' => 'required|string',
            'file' => 'nullable|file|max:10240',
        ]);

        $lastmateri = DB::table('tb_materi')->orderByDesc('id_materi')->first();

        $fileNamemateri = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileNamemateri = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('materi'), $fileNamemateri);
        }

        $tahunAjaran = DB::table('tb_tahun_ajaran')->where('is_active', 1)->first();
        $id_tahun_ajaran = $tahunAjaran ? $tahunAjaran->id_tahun_ajaran : null;

        DB::table('tb_materi')->insert([
            'nama_materi' => $request->nama_materi,
            'id_mapel' => $request->id_mapel,
            'id_kelas' => $request->id_kelas,
            'keterangan_materi' => $request->keterangan_materi,
            'file' => $fileNamemateri,
            'id_tahun_ajaran' => $id_tahun_ajaran,
        ]);

        return redirect('/pamong/tabelmateri')->with('success', 'Materi berhasil ditambahkan.');
    }
public function editmateri($id_materi)
{
    $id_akun = session('user')->id_akun;

    // Ambil pamong yang login
    $pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->first();
    if (!$pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    $id_pamong = $pamong->id_pamong;

    // Ambil materi yang akan diedit
    $materi = DB::table('tb_materi')->where('id_materi', $id_materi)->first();

    // Mapel yang diajar pamong ini
    $mapel = DB::table('tb_mapel')
        ->join('tb_pamong', 'tb_mapel.id_mapel', '=', 'tb_pamong.id_mapel')
        ->where('tb_pamong.id_pamong', $id_pamong)
        ->select('tb_mapel.id_mapel', 'tb_mapel.nama_mapel')
        ->get();

    // Kelas yang diampu pamong ini
    $kelas = DB::table('tb_pamong_kelas')
        ->join('tb_kelas', 'tb_pamong_kelas.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_pamong_kelas.id_pamong', $id_pamong)
        ->select('tb_kelas.id_kelas', 'tb_kelas.nama_kelas')
        ->distinct()
        ->get();

    return view('pamong.v_editmateri', compact('materi', 'mapel', 'kelas'));
}

public function updateMateri(Request $request, $id_materi)
{
    $request->validate([
        'nama_materi' => 'required|string|max:255',
        'keterangan_materi' => 'required|string',
        'id_mapel' => 'required|exists:tb_mapel,id_mapel',
        'id_kelas' => 'required|exists:tb_kelas,id_kelas',
        'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar|max:20480',
    ]);

    $materi = DB::table('tb_materi')->where('id_materi', $id_materi)->first();
    if (!$materi) {
        return redirect()->back()->with('error', 'Materi tidak ditemukan!');
    }

    $fileName = $materi->file;

    if ($request->hasFile('file')) {
        // Hapus file lama
        if ($fileName && file_exists(public_path('materi/' . $fileName))) {
            unlink(public_path('materi/' . $fileName));
        }

        // Simpan file baru
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('materi'), $fileName);
    }

    // Update data materi
    DB::table('tb_materi')->where('id_materi', $id_materi)->update([
        'nama_materi' => $request->nama_materi,
        'keterangan_materi' => $request->keterangan_materi,
        'id_mapel' => $request->id_mapel,
        'id_kelas' => $request->id_kelas,
        'file' => $fileName,
    ]);

    return redirect()->route('materi')->with('success', 'Materi berhasil diperbarui!');
}

public function pilihKelasMateri()
{
    $id_akun = session('user')->id_akun;

    // Ambil id_pamong dari id_akun
    $id_pamong = DB::table('tb_pamong')
        ->where('id_akun', $id_akun)
        ->value('id_pamong');

    if (!$id_pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    // Ambil daftar kelas yang diajarkan pamong dari tb_pamong_kelas
    $kelas = DB::table('tb_kelas')
        ->join('tb_pamong_kelas', 'tb_kelas.id_kelas', '=', 'tb_pamong_kelas.id_kelas')
        ->where('tb_pamong_kelas.id_pamong', $id_pamong)
        ->select('tb_kelas.id_kelas', 'tb_kelas.nama_kelas')
        ->distinct()
        ->get();

    return view('pamong.v_pilihkelasmateri', compact('kelas'));
}

public function pilihKelasTugas()
{
    $id_akun = session('user')->id_akun;

    $id_pamong = DB::table('tb_pamong')
        ->where('id_akun', $id_akun)
        ->value('id_pamong');

    if (!$id_pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    $kelas = DB::table('tb_kelas')
        ->join('tb_pamong_kelas', 'tb_kelas.id_kelas', '=', 'tb_pamong_kelas.id_kelas')
        ->where('tb_pamong_kelas.id_pamong', $id_pamong)
        ->select('tb_kelas.id_kelas', 'tb_kelas.nama_kelas')
        ->distinct()
        ->get();

    return view('pamong.v_pilihkelastugas', compact('kelas'));
}


    public function formtambahtugas() 
{
    $id_akun = session('user')->id_akun;

    // Ambil data pamong berdasarkan id_akun login
    $pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->first();
    if (!$pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    $id_pamong = $pamong->id_pamong;

    // Ambil mata pelajaran yang diajar oleh pamong ini
    $mapel = DB::table('tb_mapel')
        ->join('tb_pamong', 'tb_mapel.id_mapel', '=', 'tb_pamong.id_mapel')
        ->where('tb_pamong.id_pamong', $id_pamong)
        ->select('tb_mapel.id_mapel', 'tb_mapel.nama_mapel')
        ->get();

    // Ambil kelas yang diampu pamong ini
    $kelas = DB::table('tb_pamong_kelas')
        ->join('tb_kelas', 'tb_pamong_kelas.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_pamong_kelas.id_pamong', $id_pamong)
        ->select('tb_kelas.id_kelas', 'tb_kelas.nama_kelas')
        ->distinct()
        ->get();

    // (Bagian ini aslinya untuk melihat data materi, tidak dibutuhkan untuk form tambah tugas)
    $dataMateri = DB::table('tb_materi')
        ->leftJoin('tb_kelas', 'tb_materi.id_kelas', '=', 'tb_kelas.id_kelas')
        ->leftJoin('tb_mapel', 'tb_materi.id_mapel', '=', 'tb_mapel.id_mapel')
        ->select('tb_materi.*', 'tb_mapel.nama_mapel', 'tb_kelas.nama_kelas')
        ->get();

    // Tampilkan view form tambah materi
    return view('pamong.v_tambahtugas', compact('kelas', 'mapel', 'dataMateri'));
}

public function edittugas($id_tugas)
{
    $id_akun = session('user')->id_akun;

    // Ambil data pamong berdasarkan akun
    $pamong = DB::table('tb_pamong')->where('id_akun', $id_akun)->first();
    if (!$pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    $id_pamong = $pamong->id_pamong;

    // Ambil data tugas yang ingin diedit
    $tugas = DB::table('tb_tugas')->where('id_tugas', $id_tugas)->first();

    // Ambil mapel yang diajarkan pamong
    $mapel = DB::table('tb_mapel')
        ->join('tb_pamong', 'tb_mapel.id_mapel', '=', 'tb_pamong.id_mapel')
        ->where('tb_pamong.id_pamong', $id_pamong)
        ->select('tb_mapel.id_mapel', 'tb_mapel.nama_mapel')
        ->get();

    // Ambil kelas yang diampu pamong
    $kelas = DB::table('tb_pamong_kelas')
        ->join('tb_kelas', 'tb_pamong_kelas.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_pamong_kelas.id_pamong', $id_pamong)
        ->select('tb_kelas.id_kelas', 'tb_kelas.nama_kelas')
        ->distinct()
        ->get();

    return view('pamong.v_edittugas', compact('tugas', 'mapel', 'kelas'));
}

    public function updateTugas(Request $request, $id_tugas)
{
    $request->validate([
        'judul_tugas' => 'required',
        'deskripsi' => 'nullable',
        'id_mapel' => 'required',
        'id_kelas' => 'required',
        'tanggal_deadline' => 'required|date',
        'file_tugas' => 'nullable|file|mimes:pdf,docx,doc,zip,rar',
    ]);

    $tugas = DB::table('tb_tugas')->where('id_tugas', $id_tugas)->first();
    if (!$tugas) {
        return redirect()->back()->with('error', 'Tugas tidak ditemukan!');
    }

    $fileName = $tugas->file_tugas;
    if ($request->hasFile('file_tugas')) {
        $file = $request->file('file_tugas');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('file_tugas'), $fileName);
    }

    DB::table('tb_tugas')->where('id_tugas', $id_tugas)->update([
        'judul_tugas' => $request->judul_tugas,
        'deskripsi' => $request->deskripsi,
        'id_mapel' => $request->id_mapel,
        'id_kelas' => $request->id_kelas,
        'tanggal_deadline' => $request->tanggal_deadline,
        'file_tugas' => $fileName,
    ]);

    return redirect()->route('pamong.tugas')->with('success', 'Tugas berhasil diperbarui!');
}


    
   public function deleteTugas($id_tugas)
{
    try {
        // Cek apakah tugas ada
        $tugas = DB::table('tb_tugas')->where('id_tugas', $id_tugas)->first();
        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan.');
        }

        // Hapus tugas
        DB::table('tb_tugas')->where('id_tugas', $id_tugas)->delete();
        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
        
    } catch (\Illuminate\Database\QueryException $e) {
        // Jika gagal karena foreign key (pengumpulan tugas masih ada)
        return redirect()->back()->with('error', 'Tidak bisa menghapus tugas karena masih ada pengumpulan tugas terkait.');
    }
}

public function deletemateri($id)
{
    // Ambil data materi berdasarkan ID
    $materi = DB::table('tb_materi')->where('id_materi', $id)->first();

    // Jika materi ditemukan dan memiliki file, hapus file-nya dari folder public/materi
    if ($materi && $materi->file && file_exists(public_path('materi/' . $materi->file))) {
        unlink(public_path('materi/' . $materi->file));
    }

    // Hapus data materi dari database
    DB::table('tb_materi')->where('id_materi', $id)->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Materi berhasil dihapus.');
}

public function downloadTugas($filename)
{
    $path = public_path('jawaban/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan.');
    }

    return response()->download($path);
}


    
}
