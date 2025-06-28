<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\M_admin;

class C_admin extends Controller
{
    public function __construct()
    {
        $this->M_admin = new M_admin();
    }


    public function index(){
        return view('admin.v_dashboard');
    }

    public function indexsiswa(Request $request)
{
    $kelas = DB::table('tb_kelas')->select('id_kelas', 'nama_kelas')->get();

    $query = DB::table('tb_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->join('tb_paket', 'tb_siswa.id_paket', '=', 'tb_paket.id_paket')
        ->select(
            'tb_siswa.*',
            'tb_kelas.nama_kelas as kelas',
            'tb_paket.nama_paket as paket'
        );

    if ($request->has('cari') && $request->cari != '') {
        $query->where(function ($q) use ($request) {
            $q->where('tb_siswa.nama_lengkap', 'like', '%' . $request->cari . '%')
              ->orWhere('tb_siswa.nisn', 'like', '%' . $request->cari . '%');
        });
    }

    $dataSiswa = $query->get();

    return view('admin.v_tabelsiswa', compact('dataSiswa', 'kelas'));
}


    public function detail($id)
{
    $siswa = DB::table('tb_siswa')
        ->leftJoin('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->leftJoin('tb_paket', 'tb_siswa.id_paket', '=', 'tb_paket.id_paket')
        ->select('tb_siswa.*', 'tb_kelas.nama_kelas as kelas', 'tb_paket.nama_paket as paket')
        ->where('tb_siswa.id_siswa', $id)
        ->first();

    return view('admin.v_detailsiswa', compact('siswa'));
}


    
    public function indexpamong(Request $request)
{
    $cari = $request->input('cari');

    $query = DB::table('tb_pamong')
        ->join('tb_mapel', 'tb_pamong.id_mapel', '=', 'tb_mapel.id_mapel')
        ->select('tb_pamong.*', 'tb_mapel.nama_mapel');

    if ($cari) {
        $query->where(function ($q) use ($cari) {
            $q->where('tb_pamong.nama_pamong', 'like', '%' . $cari . '%')
              ->orWhere('tb_mapel.nama_mapel', 'like', '%' . $cari . '%');
        });
    }

    $datapamong = $query->get();

    return view('admin.v_tabelpamong', compact('datapamong'));
}



    public function indexkelas()
{
    $datakelas = DB::table('tb_kelas')
        ->join('tb_paket', 'tb_kelas.id_paket', '=', 'tb_paket.id_paket')
        ->select('tb_kelas.id_kelas', 'tb_kelas.nama_kelas', 'tb_paket.nama_paket')
        ->get();

    return view('admin.v_tabelkelas', compact('datakelas'));
}

    public function indexmapel(Request $request)
{
    $cari = $request->input('cari');

    $query = DB::table('tb_mapel')
        ->leftJoin('tb_paket', 'tb_mapel.id_paket', '=', 'tb_paket.id_paket')
        ->select('tb_mapel.*', 'tb_paket.nama_paket');

    if ($cari) {
        $query->where(function($q) use ($cari) {
            $q->where('tb_mapel.nama_mapel', 'like', '%' . $cari . '%')
              ->orWhere('tb_paket.nama_paket', 'like', '%' . $cari . '%');
        });
    }

    $datamapel = $query->get();

    return view('admin.v_tabelmapel', compact('datamapel'));
}



    public function tambahsiswa(Request $request)
    {
        foreach ($request->siswa as $s) {
            DB::table('tb_siswa')->insert([
                'nis' => $s['no_induk'],
                'nama'     => $s['nama'],
                'jenis_kelamin'   => $s['gender'],
                'id_kelas'    => $s['kelas'],
            ]);

            $lastAkun = DB::table('tb_akun')
            ->select('id_akun')
            ->orderByDesc('id_akun')
            ->first();

            if ($lastAkun) {
            $lastNumakun = (int) substr($lastAkun->id_akun, 1); // ambil angka setelah 'C'
            $idAkun = 'A' . str_pad($lastNumakun + 1, 4, '0', STR_PAD_LEFT);
            } else {
            $idAkun = 'A0001'; // Kalau belum ada data
            }

            DB::table('tb_akun')->insert([
                'id_akun' => $idAkun,
                'username'     => $s['nama'],
                'password' => bcrypt($s['no_induk']),
                'tipe_akun' => 'siswa',
            ]);
        }

        return redirect('/admin/tabelsiswa')->with('success', 'Data Siswa Berhasil Ditambahkan.');
    }

    public function tambahmateri(Request $request)
    {
        foreach ($request->materi as $s) {
        $lastmateri = DB::table('tb_materi')
        ->select('id_materi')
        ->orderByDesc('id_materi')
        ->first();
    
        if ($lastmateri) {
        $lastNummateri = (int) substr($lastmateri->id_materi, 1); // ambil angka setelah 'C'
        $idmateri = 'N' . str_pad($lastNummateri + 1, 4, '0', STR_PAD_LEFT);
        } else {
        $idmateri = 'N0001'; // Kalau belum ada data
        }

            DB::table('tb_materi')->insert([
                'id_materi' => $idmateri,
                'nama_materi' => $s['nama_materi'],
                'id_mapel'     => $s['mapel'],
                'id_kelas'    => $s['kelas'],
            ]);


        }
        return redirect('/admin/tabelmateri')->with('success', 'Data Berhasil Ditambahkan.');
    }

    public function tambahPamong()
{
    $mapel = DB::table('tb_mapel')->get(); // untuk dropdown
    return view('admin.v_tambahpamong', compact('mapel'));
}

public function simpanpamong(Request $request)
{
    $request->validate([
        'nama_pamong' => 'required|string|max:100',
        'id_mapel' => 'required',
    ]);

    DB::table('tb_pamong')->insert([
        'nama_pamong' => $request->nama_pamong,
        'id_mapel' => $request->id_mapel,
        // tanpa id_akun
    ]);

    return redirect()->route('admin.pamong')->with('success', 'Data pamong berhasil ditambahkan!');
}



    // Tampilkan form edit pamong
   public function editPamong($id)
{
    $pamong = DB::table('tb_pamong')->where('id_pamong', $id)->first();
    $mapel = DB::table('tb_mapel')->get(); // untuk dropdown

    if (!$pamong) {
        return redirect()->back()->with('error', 'Data pamong tidak ditemukan.');
    }

    return view('admin.v_editpamong', compact('pamong', 'mapel'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_pamong' => 'required|string|max:100',
        'id_mapel' => 'required|exists:tb_mapel,id_mapel',
    ]);

    DB::table('tb_pamong')->where('id_pamong', $id)->update([
        'nama_pamong' => $request->nama_pamong,
        'id_mapel' => $request->id_mapel,
    ]);

    return redirect()->route('admin.pamong')->with('success', 'Data pamong berhasil diperbarui.');
}


public function destroyPamong($id)
{
    // Cek apakah data pamong ada
    $pamong = DB::table('tb_pamong')->where('id_pamong', $id)->first();

    if (!$pamong) {
        return redirect()->route('admin.pamong')->with('error', 'Data pamong tidak ditemukan.');
    }

    // Hapus data
    DB::table('tb_pamong')->where('id_pamong', $id)->delete();

    return redirect()->route('admin.pamong')->with('success', 'Data pamong berhasil dihapus.');
}


    public function tambahkelas(Request $request)
    {
        foreach ($request->kelas as $s) {
        $lastAkun = DB::table('tb_kelas')
            ->select('id_kelas')
            ->orderByDesc('id_kelas')
            ->first();

            if ($lastAkun) {
            $lastNumakun = (int) substr($lastAkun->id_kelas, 1); // ambil angka setelah 'C'
            $idkelas = 'K' . str_pad($lastNumakun + 1, 4, '0', STR_PAD_LEFT);
            } else {
            $idkelas = 'K0001'; // Kalau belum ada data
            }

            DB::table('tb_kelas')->insert([
                'id_kelas' => $idkelas,
                'kelas'     => $s['kelas'],
            ]);
        }
        return redirect('/admin/tabelkelas')->with('success', 'Data Kelas Berhasil Ditambahkan.');
    }

    public function createmapel()
{
    $paket = DB::table('tb_paket')->get();
    return view('admin.v_tambahmapel', compact('paket'));
}
    // Simpan mapel baru
   public function storemapel(Request $request)
{
    $request->validate([
        'nama_mapel' => 'required',
        'id_paket' => 'required',
    ]);

    DB::table('tb_mapel')->insert([
        'nama_mapel' => $request->nama_mapel,
        'id_paket' => $request->id_paket,
    ]);

    return redirect()->route('admin.mapel')->with('success', 'Mata Pelajaran berhasil ditambahkan.');
}

    // Tampilkan form edit mapel
    public function editmapel($id_mapel)
{
    $mapel = DB::table('tb_mapel')->where('id_mapel', $id_mapel)->first();
    $paket = DB::table('tb_paket')->get();

    return view('admin.v_editmapel', compact('mapel', 'paket'));
}

    // Update mapel
public function updatemapel(Request $request, $id)
{
    $request->validate([
        'nama_mapel' => 'required|string|max:100',
        'id_paket' => 'required|exists:tb_paket,id_paket',
    ]);

    DB::table('tb_mapel')->where('id_mapel', $id)->update([
        'nama_mapel' => $request->nama_mapel,
        'id_paket' => $request->id_paket,
    ]);

    return redirect()->route('admin.mapel')->with('success', 'Mata pelajaran berhasil diupdate.');
}

        public function hapusMapel($id)
        {
            DB::table('tb_mapel')->where('id_mapel', $id)->delete();
            return redirect()->route('admin.mapel')->with('success', 'Data mapel berhasil dihapus.');
        }



    public function updatesiswa($nis)
    {
        Request()->validate([
            'nis' => 'required',
            'nama' => 'required|min:5',
            'jenis_kelamin' => 'required',
            'id_kelas' => 'required',
        ], [
            'nama.required' => 'Nama Produk wajib di isi !',
            'nama.min' => 'Nama Produk minimal 5 karakter',
            'jenis_kelamin.required' => 'jenis_kelamin Produk wajib di isi !',
        ]);

        $data = [
            'nis' => Request()->nis,
            'nama' => Request()->nama,
            'jenis_kelamin' => Request()->jenis_kelamin,
            'id_kelas' => Request()->id_kelas,
        ];

        $this->M_admin->editDatasiswa($nis, $data);
        
        return redirect()->route('siswa')->with('pesan', 'Data berhasil diperbarui!');
    }


        public function updatekelas($id_kelas)
        {
            Request()->validate([
                'id_kelas' => 'required',
                'kelas' => 'required|min:5',
            ], [
                'kelas.required' => 'Nama Produk wajib di isi !',
                'kelas.min' => 'Nama Produk minimal 5 karakter',
            ]);
    
            $data = [
                'id_kelas' => Request()->id_kelas,
                'kelas' => Request()->kelas,
                'nip' => Request()->id_pamong,
            ];

        $this->M_admin->editDatakelas($id_kelas, $data);
        
        return redirect()->route('kelas')->with('pesan', 'Data berhasil diperbarui!');
    }


   public function hapussiswa($id)
{
    DB::table('tb_siswa')->where('id_siswa', $id)->delete();
    return redirect()->route('admin.datasiswa')->with('success', 'Data siswa berhasil dihapus.');
}


    public function deletekelas($id_kelas)
    {
        // Hapus atau delete foto
        $kelas = $this->M_admin->detailDatakelas($id_kelas);
    
        $this->M_admin->deleteDatakelas($id_kelas);
        return redirect()->route('kelas')->with('success', 'Data Berhasil Dihapus');
    }

    //paket
    public function indexpaket()
{
    $datapaket = DB::table('tb_paket')->get();
    return view('admin.v_tabelpaket', compact('datapaket'));
}

// Tampilkan form filter laporan nilai
public function kelolaLaporan()
{
    return view('admin.v_kelolalaporan');
}


// Cetak laporan nilai berdasarkan filter
public function cetakLaporanNilai(Request $request)
{
    $request->validate([
        'id_kelas' => 'required|exists:tb_kelas,id_kelas',
        'id_mapel' => 'required|exists:tb_mapel,id_mapel',
    ]);

    $id_tahun_ajaran = DB::table('tb_tahun_ajaran')->where('is_active', 1)->value('id_tahun_ajaran');

    $nilai = DB::table('tb_nilai')
        ->join('tb_siswa', 'tb_nilai.id_siswa', '=', 'tb_siswa.id_siswa')
        ->join('tb_tugas', 'tb_nilai.id_tugas', '=', 'tb_tugas.id_tugas')
        ->where('tb_siswa.id_kelas', $request->id_kelas)
        ->where('tb_tugas.id_mapel', $request->id_mapel)
        ->where('tb_tugas.id_tahun_ajaran', $id_tahun_ajaran)
        ->select('tb_siswa.nama_lengkap', 'tb_siswa.nisn', 'tb_tugas.judul_tugas', 'tb_nilai.nilai', 'tb_nilai.komentar')
        ->orderBy('tb_siswa.nama_lengkap')
        ->get();

    return view('admin.v_cetaklaporannilai', [
        'nilai' => $nilai,
        'kelas' => DB::table('tb_kelas')->where('id_kelas', $request->id_kelas)->first(),
        'mapel' => DB::table('tb_mapel')->where('id_mapel', $request->id_mapel)->first(),
    ]);
}
public function laporanPerSiswa(Request $request)
{
    $query = DB::table('tb_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->select('tb_siswa.*', 'tb_kelas.nama_kelas');

    if ($request->has('cari')) {
        $cari = $request->cari;
        $query->where(function($q) use ($cari) {
            $q->where('tb_siswa.nama_lengkap', 'like', "%$cari%")
              ->orWhere('tb_siswa.nisn', 'like', "%$cari%");
        });
    }

    $siswa = $query->get();
return view('admin.v_laporansiswa', compact('siswa'));

}

public function cetakPerSiswa($id_siswa)
{
    // Ambil data siswa lengkap beserta nama kelas
    $siswa = DB::table('tb_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_siswa.id_siswa', $id_siswa)
        ->select('tb_siswa.*', 'tb_kelas.nama_kelas as kelas')
        ->first();

    // Ambil semua nilai tugas siswa
    $nilai = DB::table('tb_nilai')
        ->join('tb_tugas', 'tb_nilai.id_tugas', '=', 'tb_tugas.id_tugas')
        ->join('tb_mapel', 'tb_tugas.id_mapel', '=', 'tb_mapel.id_mapel')
        ->where('tb_nilai.id_siswa', $id_siswa)
        ->select('tb_mapel.nama_mapel', 'tb_tugas.judul_tugas', 'tb_nilai.nilai', 'tb_nilai.komentar')
        ->get();

    return view('admin.v_cetaklaporansiswa', compact('siswa', 'nilai'));
}

public function downloadPerSiswa($id_siswa)
{
    // Ambil data siswa
    $siswa = DB::table('tb_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_siswa.id_siswa', $id_siswa)
        ->select('tb_siswa.*', 'tb_kelas.nama_kelas')
        ->first();

    if (!$siswa) {
        return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
    }

    // Ambil nilai-nilai siswa tersebut
    $nilai = DB::table('tb_nilai')
        ->join('tb_tugas', 'tb_nilai.id_tugas', '=', 'tb_tugas.id_tugas')
        ->join('tb_mapel', 'tb_tugas.id_mapel', '=', 'tb_mapel.id_mapel')
        ->where('tb_nilai.id_siswa', $id_siswa)
        ->select(
            'tb_mapel.nama_mapel',
            'tb_tugas.judul_tugas',
            'tb_nilai.nilai',
            'tb_nilai.komentar'
        )
        ->orderBy('tb_mapel.nama_mapel')
        ->get();

    // Load PDF
    $pdf = Pdf::loadView('admin.v_cetaklaporansiswa', compact('siswa', 'nilai'));

    $namaFile = 'laporan_nilai_' . preg_replace('/[^A-Za-z0-9]/', '_', $siswa->nama_lengkap) . '.pdf';
    return $pdf->download($namaFile);
}


public function laporanPerMapel()
{
    // Ambil semua mapel yang memiliki tugas
    $mapelList = DB::table('tb_mapel')
        ->join('tb_tugas', 'tb_mapel.id_mapel', '=', 'tb_tugas.id_mapel')
        ->select('tb_mapel.id_mapel', 'tb_mapel.nama_mapel')
        ->distinct()
        ->get();

    return view('admin.v_laporanmapel', compact('mapelList'));
}

public function cetakPerMapel($id_mapel)
{
    $mapel = DB::table('tb_mapel')->where('id_mapel', $id_mapel)->first();

    $nilai = DB::table('tb_nilai')
        ->join('tb_tugas', 'tb_nilai.id_tugas', '=', 'tb_tugas.id_tugas')
        ->join('tb_siswa', 'tb_nilai.id_siswa', '=', 'tb_siswa.id_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_tugas.id_mapel', $id_mapel)
        ->select(
            'tb_siswa.nama_lengkap',
            'tb_kelas.nama_kelas',
            'tb_tugas.judul_tugas',
            'tb_nilai.nilai',
            'tb_nilai.komentar'
        )
        ->orderBy('tb_siswa.nama_lengkap')
        ->get();

    return view('admin.v_cetaklaporanmapel', compact('mapel', 'nilai'));
}

public function downloadPerMapel($id_mapel)
{
    $mapel = DB::table('tb_mapel')->where('id_mapel', $id_mapel)->first();

    $nilai = DB::table('tb_nilai')
        ->join('tb_tugas', 'tb_nilai.id_tugas', '=', 'tb_tugas.id_tugas')
        ->join('tb_siswa', 'tb_nilai.id_siswa', '=', 'tb_siswa.id_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
        ->where('tb_tugas.id_mapel', $id_mapel)
        ->select(
            'tb_siswa.nama_lengkap',
            'tb_kelas.nama_kelas',
            'tb_tugas.judul_tugas',
            'tb_nilai.nilai',
            'tb_nilai.komentar'
        )
        ->orderBy('tb_siswa.nama_lengkap')
        ->get();

    $pdf = Pdf::loadView('admin.v_cetaklaporanmapel', compact('mapel', 'nilai'));
    return $pdf->download('laporan_nilai_' . $mapel->nama_mapel . '.pdf');
}





}
