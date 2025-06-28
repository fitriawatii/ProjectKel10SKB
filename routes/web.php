<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_pamong;
use App\Http\Controllers\C_Pesertadidik;
use App\Http\Controllers\C_Home;
use App\Http\Controllers\C_User;
use App\Http\Controllers\C_admin;
use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_formulirprogram;
use App\Http\Controllers\C_kelolaformulirprogram;
use App\Http\Controllers\C_formulirpaud;
use App\Http\Controllers\C_Tpesertadidik;
use App\Http\Controllers\C_Nilai;
use App\Http\Controllers\C_Auth;
use App\Http\Controllers\C_Akun;
use App\Http\Controllers\C_jadwal;
use App\Http\Controllers\C_tahunajaran;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route :: view('/contact','contact');

// Route :: view('/contact','contact',[
// 'name' => 'syifa nazwa aulia',
// 'email' => 'syifana@gmail.com']);

// Route::get('/contact', function () {
//     return view('contact', ['name'=> 'Syifa Nazwa Aulia','email'=>'syifana@gmail.com']);
// });

// Route::get('/about', function () {
//     return ('Halaman About');
// });

// Route :: view('/admin', 'admin/admin');
// Route :: view('/admin', 'admin.admin');

// Route::get('/mahasiswa/', function ($nama_mahasiswa='Syifa Nazwa Aulia') {
//     return view('mahasiswa',['nama_mahasiswa'=>$nama_mahasiswa]);
// });

// Route::view('/about','about',[
// 'nama' => 'Syifa Nazwa Aulia',
// 'alamat' => 'Subang, Subang'
// ]);

// Route::get('/',Function() {
//     return view('v_home');
// });

// Route::get('/', function () {
//     return view('v_index');
// });

Route::view('/pamongbelajar','v_pamongbelajar');
Route::view('/about','v_about');
Route::view('/contact','v_contact');
Route::view('/login','v_login');
Route::view('/barang','v_barang');
Route::view('/','v_index');
Route::view('/admin/tabelsiswa','admin.v_tabelsiswa');
Route::view('/pesertadidik','v_pesertadidik');

Route::get('/home',[C_Home::class,'index']);
Route::get('/home/about/{id}',[C_Home::class,'about']);
Route::get('/user',[C_User::class,'index']);
Route::get('/register',[C_Register::class,'index']);
Route::get('/',[C_Login::class,'index']);
Route::get('login',[C_Login::class,'tampilanlogin']);

Route::get('/pamong/dashboard', [C_pamong::class, 'dashboard'])->name('pamong.dashboard');
Route::get('/pamongbelajar',[C_Pamongbelajar::class,'index'])->name('pamongbelajar');
Route::get('/pamongbelajar/materi',[C_Pamongbelajar::class,'materi'])->name('pamongmateri');
Route::get('/pamongbelajar/detail/{id_pamongbelajar}',[C_Pamongbelajar::class,'detail']);
Route::get('/pamongbelajar/edit/{id_pamongbelajar}',[C_Pamongbelajar::class,'edit']);
Route::post('/pamongbelajar/update/{id_pamongbelajar}', [C_Pamongbelajar::class, 'update']);
Route::get('/pamongbelajar/delete/{id_pamongbelajar}', [C_Pamongbelajar::class, 'delete']);
Route::get('/pamongbelajar/add', [C_Pamongbelajar::class, 'add']);
Route::post('/pamongbelajar/insert', [C_Pamongbelajar::class, 'insert']);

Route::get('/pesertadidik/dashboard', [C_Tpesertadidik::class, 'dashboard'])->name('pesertadidik.dashboard');
Route::get('/pesertadidik', [C_Pesertadidik::class, 'index'])->name('pesertadidik');
Route::get('/pesertadidik/detail/{nisn}', [C_Pesertadidik::class, 'detail']);
Route::get('/pesertadidik/add', [C_Pesertadidik::class, 'add'])->name('addpeserta');
Route::post('/pesertadidik/add', [C_Pesertadidik::class, 'insert']);
Route::get('/pesertadidik/edit/{nisn}', [C_Pesertadidik::class, 'edit']);
Route::post('/pesertadidik/update/{nisn}', [C_Pesertadidik::class, 'update']);
Route::get('/pesertadidik/delete/{nisn}', [C_Pesertadidik::class, 'delete']);


Route::get('/admin',[C_admin::class,'index'])->name('dashboard');
Route::get('/admin/tabelsiswa',[C_admin::class,'indexsiswa'])->name('siswa.index');
Route::get('/admin/siswa/detail/{id}', [C_admin::class, 'detail'])->name('siswa.detail');
Route::delete('/admin/siswa/{id}', [C_admin::class, 'hapussiswa'])->name('siswa.hapus');


Route::post('/admin/tabelsiswa/tambah', [C_admin::class, 'tambahsiswa'])->name('tambah.siswa');
Route::get('/admin/siswa/edit/{nis}', [C_admin::class, 'editsiswa']);
Route::post('/admin/siswa/update/{nis}', [C_admin::class, 'updatesiswa']);
Route::delete('/admin/siswa/hapus/{nis}', [C_admin::class, 'deletesiswa'])->name('delete.siswa');
Route::get('/admin/datasiswa', [C_admin::class, 'indexsiswa'])->name('admin.datasiswa');

Route::get('/admin/tabelkelas',[C_admin::class,'indexkelas'])->name('kelas');
Route::post('/admin/tabelkelas/tambah', [C_admin::class, 'tambahkelas'])->name('tambah.kelas');
Route::delete('/admin/tabelkelas/hapus/{id_kelas}', [C_admin::class, 'deletekelas'])->name('delete.kelas');
Route::get('/admin/tabelmapel',[C_admin::class,'indexmapel'])->name('admin.mapel');

Route::get('/admin/tabelpamong',[C_admin::class,'indexpamong'])->name('admin.pamong');
Route::get('/admin/pamong/tambah', [C_admin::class, 'tambahPamong'])->name('tambah.pamong');
Route::post('/admin/pamong/simpan', [C_admin::class, 'simpanPamong'])->name('simpan.pamong');
Route::get('/admin/pamong/edit/{id}', [C_admin::class, 'editPamong'])->name('edit.pamong');
Route::post('admin/pamong/update/{id}', [C_admin::class, 'update'])->name('update.pamong');
Route::delete('/admin/pamong/delete/{id}', [C_admin::class, 'destroyPamong'])->name('hapus.pamong');
Route::get('admin/mapel/tambah', [C_admin::class, 'createmapel'])->name('tambah.mapel');
Route::post('admin/mapel/simpan', [C_admin::class, 'storemapel'])->name('simpan.mapel');

Route::get('admin/mapel/edit/{id}', [C_admin::class, 'editmapel'])->name('edit.mapel');
Route::post('admin/mapel/update/{id}', [C_admin::class, 'updatemapel'])->name('update.mapel');
Route::get('/admin/mapel/hapus/{id}', [C_admin::class, 'hapusMapel'])->name('hapus.mapel');


Route::get('/admin/laporannilai', [C_Admin::class, 'kelolaLaporan'])->name('admin.laporannilai');
Route::get('/admin/laporannilai/per-siswa', [C_Admin::class, 'laporanPerSiswa'])->name('admin.laporannilai.persiswa');
Route::get('/admin/laporannilai/per-matapelajaran', [C_Admin::class, 'laporanPerMapel'])->name('admin.laporannilai.permapel');
Route::get('/admin/laporannilai/per-siswa/cetak/{id_siswa}', [C_Admin::class, 'cetakPerSiswa'])->name('admin.laporannilai.persiswa.cetak');
Route::get('/admin/laporannilai/permapel/{id_mapel}/download', [C_Admin::class, 'downloadPerSiswa'])->name('admin.laporannilai.persiswa.download');
Route::get('/admin/laporannilai/per-mapel', [C_admin::class, 'laporanPerMapel'])->name('admin.laporannilai.permapel');
Route::get('/admin/laporannilai/per-mapel/{id}/cetak', [C_admin::class, 'cetakPerMapel'])->name('admin.laporannilai.permapel.cetak');
Route::get('/admin/laporannilai/per-mapel/{id}/download', [C_admin::class, 'downloadPerMapel'])->name('admin.laporannilai.permapel.download');





Route::get('/admin/kelas/edit/{id_kelas}', [C_admin::class, 'editkelas']);
Route::post('/admin/kelas/update/{id_kelas}', [C_admin::class, 'updatekelas'])->name('update.kelas');
Route::delete('/admin/pamong/hapus/{nip}', [C_admin::class, 'deletepamong'])->name('delete.pamong');
Route::get('/logout',[C_Login::class,'logout'])->name('logout');

Route::get('/pamong',[C_pamong::class,'index']);
Route::get('/pamong/tabelmateri',[C_pamong::class,'indexmateri'])->name('materi');
Route::get('/pamong/tabelmateri/tambah', [C_pamong::class, 'formtambah'])->name('form.tambahmateri');
Route::post('/pamong/tabelmateri/tambah/insert', [C_pamong::class, 'tambahmateri'])->name('insert.materi');
Route::get('/pamong/tabelmateri/edit/{id_materi}', [C_pamong::class, 'editmateri']);
Route::delete('/pamong/tabelmateri/hapus/{id_materi}', [C_pamong::class, 'deletemateri'])->name('delete.materi');
Route::post('/pamong/tabelmateri/update/{id_materi}', [C_pamong::class, 'updatemateri'])->name('update.materi');

//dipakai
Route::get('/formulirprogram', [C_kelolaformulirprogram::class, 'create'])->name('formulirprogram.create');
Route::post('/formulirprogram', [C_kelolaformulirprogram::class, 'store'])->name('formulirprogram.store');
Route::post('/admin/terima/{id}', [C_kelolaformulirprogram::class, 'terimaPendaftar'])->name('terima.pendaftar');
Route::get('/admin/datapendaftar', [C_kelolaformulirprogram::class, 'datapendaftar'])->name('datapendaftar');



Route::get('/admin/formulirprogram', [C_kelolaformulirprogram::class, 'datapendaftar'])->name('kelola.formulirprogram');
Route::get('/admin/formulirprogram/detail/{id_daftarprogram}', [C_kelolaformulirprogram::class, 'show'])->name('formulir.show');
Route::get('/admin/formulirprogram/edit/{id_daftarprogram}', [C_kelolaformulirprogram::class, 'edit'])->name('formulir.edit');
Route::put('/admin/formulirprogram/update/{id_daftarprogram}', [C_kelolaformulirprogram::class, 'update'])->name('formulir.update');
Route::delete('/admin/formulirprogram/delete/{id_daftarprogram}', [C_kelolaformulirprogram::class, 'delete'])->name('formulir.destroy');

Route::get('/formulirpaud', [C_formulirpaud::class, 'create'])->name('formulirpaud.create');
Route::post('/formulirpaud', [C_formulirpaud::class, 'store'])->name('formulirpaud.store');
Route::get('/masyarakat/formpaudskb', [SKBController::class, 'create']);
Route::post('/masyarakat/formpaudskb', [SKBController::class, 'store']);

Route::get('/admin/formulirpaud', [C_kelolaformulirpaud::class, 'index'])->name('kelola.formulirpaud');
Route::get('/admin/formulirpaud/detail/{id_paud}', [C_kelolaformulirpaud::class, 'show'])->name('formulirpaud.show');
Route::get('/admin/formulirpaud/edit/{id_paud}', [C_kelolaformulirpaud::class, 'edit'])->name('formulirpaud.edit');
Route::put('/admin/formulirpaud/update/{id_paud}', [C_kelolaformulirpaud::class, 'update'])->name('formulirpaud.update');
Route::delete('/admin/formulirpaud/delete/{id_paud}', [C_kelolaformulirpaud::class, 'delete'])->name('formulirpaud.destroy');



// Menyimpan tugas baru
Route::post('/pamong/tabeltugas/store', [C_pamong::class, 'store'])->name('tugas.store');
Route::get('/pamong/tabeltugas', [C_pamong::class, 'indextugas'])->name('tugas');
Route::get('/pamong/tabeltugas/tambah', [C_pamong::class, 'formtambahtugas']);
Route::get('/tugas/{id}/edit', [C_pamong::class, 'edit'])->name('tugas.edit');
Route::delete('/pamong/tabeltugas/hapus/{id}', [C_pamong::class, 'deletetugas'])->name('tugas.delete');
Route::get('/tugas/mapel', [C_TPesertaDidik::class, 'pilihMapelTugas'])->name('tugas.mapel');
Route::get('/tugas/mapel/{id_mapel}', [C_TPesertaDidik::class, 'tugasPerMapel'])->name('tugas.permapel');




Route::get('/pamong/tabeltugas/edit/{id}', [C_pamong::class, 'edittugas']);
Route::post('/pamong/tabeltugas/update/{id}', [C_pamong::class, 'updatetugas']);
Route::get('/pamong/tabeltugas/delete/{id}', [C_pamong::class, 'deletetugas']);
Route::get('/pamong/tugas/{id}/pengumpulan', [C_pamong::class, 'lihatPengumpulan'])->name('pamong.lihatpengumpulan');
Route::get('/pengumpulan/{filename}', [C_pamong::class, 'downloadTugas'])->name('pamong.downloadTugas');


Route::get('/pamong/nilai', [C_nilai::class, 'index'])->name('pamong.nilai');
Route::post('/pamong/nilai/simpan', [C_nilai::class, 'simpan'])->name('pamong.nilai.simpan');




    // Dashboard peserta didik (view: peserta.v_pesertadidik)
    Route::get('/pesertadidik', [C_Tpesertadidik::class, 'index'])->name('pesertadidikhome');

    // Materi
    Route::get('/peserta/materi', [C_Tpesertadidik::class, 'materi'])->name('pesertadidik.materipesertadidik');
    Route::get('/peserta/materi', [C_TPesertaDidik::class, 'materi']);
    // Menampilkan daftar semua mapel yang tersedia
Route::get('/peserta/materi', [C_TPesertaDidik::class, 'daftarMapel'])->name('materi.mapel');

// Menampilkan materi berdasarkan mapel yang dipilih
Route::get('/peserta/materi/{id_mapel}', [C_TPesertaDidik::class, 'materiPerMapel'])->name('materi.permapel');





    // Tugas
    Route::get('/peserta/tugas', [C_Tpesertadidik::class, 'pilihMapelTugas'])->name('peserta.tugas');
    Route::get('/tugas', [C_TPesertaDidik::class, 'tugas'])->name('pesertadidik.tugas');
    Route::post('/kirim-tugas', [C_TPesertaDidik::class, 'kirimTugas'])->name('pesertadidik.kirimTugas');

    // Ujian
    Route::get('/peserta/ujian', [C_Tpesertadidik::class, 'ujian'])->name('peserta.ujian');

//paket
Route::get('/admin/tabelpaket', [C_admin::class, 'indexpaket'])->name('paket');


//login
// Form login & proses login
Route::get('/login', [C_Auth::class, 'loginForm'])->name('login.form');
Route::post('/login', [C_Auth::class, 'login'])->name('login');
Route::get('/logout', [C_Auth::class, 'logout'])->name('logout');

// Dashboard berdasarkan role
Route::get('/admin/dashboard', [C_Auth::class, 'dashboardAdmin'])->name('admin.dashboard'); // Dashboard Admin



Route::get('/akun', [C_Akun::class, 'index'])->name('akun.index');
Route::get('/akun/tambah', [C_Akun::class, 'formTambah'])->name('akun.tambah');
Route::post('/akun/simpan', [C_Akun::class, 'simpan'])->name('akun.simpan');
Route::delete('/akun/{id}', [C_Akun::class, 'hapus'])->name('akun.hapus');

Route::get('/jadwal', [C_jadwal::class, 'index'])->name('jadwal.index');
Route::post('/jadwal', [C_jadwal::class, 'store'])->name('jadwal.store');
Route::get('/jadwal/tambah', [C_jadwal::class, 'tambah'])->name('jadwal.tambah');
Route::get('/jadwal/edit/{id}', [C_jadwal::class, 'edit'])->name('jadwal.edit');
Route::post('/jadwal/update/{id}', [C_jadwal::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal/delete/{id}', [C_jadwal::class, 'destroy'])->name('jadwal.destroy');
Route::get('/pamong/jadwal', [C_pamong::class, 'lihatJadwal'])->name('jadwal.pamong');
Route::get('/peserta/jadwal', [C_TPesertaDidik::class, 'lihatJadwal'])->name('jadwal.siswa');

// Profil Akun (semua role bisa pakai ini)
Route::get('/akun/profil', [C_Akun::class, 'profil'])->name('akun.profil');
Route::post('/akun/profil/update', [C_Akun::class, 'updateProfil'])->name('profil.update');
Route::post('/profil', [C_Akun::class, 'updateProfil'])->name('profil.update');

Route::get('/tahunajaran', [C_TahunAjaran::class, 'index'])->name('tahunajaran.index');
Route::post('/tahunajaran', [C_TahunAjaran::class, 'store'])->name('admin.tahunajaran.store');
Route::post('/tahunajaran/aktif/{id}', [C_TahunAjaran::class, 'setAktif'])->name('admin.tahunajaran.setAktif');
Route::delete('/tahunajaran/{id}', [C_TahunAjaran::class, 'destroy'])->name('admin.tahunajaran.destroy');


// Dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', [C_Auth::class, 'dashboard']);
Route::get('/tes-login', function () {
    $akun = DB::table('tb_akun')->where('email', 'admin@example.com')->first();
    return Hash::check('admin123', $akun->password) ? 'Berhasil' : 'Gagal';
});


Route::get('/login', function () {
    return view('masyarakat.v_login');
});
