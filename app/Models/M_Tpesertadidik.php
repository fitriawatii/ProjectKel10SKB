<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_PesertaDidik extends Model
{
    protected $table = 'tb_siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    // Ambil materi berdasarkan kelas siswa
    public function getMateriBySiswa($id_siswa)
    {
        $id_kelas = DB::table('tb_siswa')
            ->where('id_siswa', $id_siswa)
            ->value('id_kelas');

        $data = DB::table('tb_materi')
            ->join('tb_mapel', 'tb_materi.id_mapel', '=', 'tb_mapel.id_mapel')
            ->where('tb_materi.id_kelas', $id_kelas)
            ->select(
                'tb_materi.*',
                'tb_mapel.nama_mapel',
                'tb_materi.keterangan_materi',
                'tb_materi.file',
                'tb_materi.id_kelas'
            )
            ->get()
            ->groupBy('nama_mapel');

        return $data;
    }

    // Ambil pengumpulan tugas berdasarkan id_siswa
    public function getPengumpulanWithDetails($id_siswa)
    {
        return DB::table('tb_pengumpulan')
            ->join('tb_tugas', 'tb_pengumpulan.id_tugas', '=', 'tb_tugas.id_tugas')
            ->where('tb_pengumpulan.id_siswa', $id_siswa)
            ->select(
                'tb_pengumpulan.*',
                'tb_tugas.judul_tugas',
                'tb_tugas.tanggal_deadline'
            )
            ->get();
    }

    // Update nilai oleh pamong
    public function updateNilai($id_nilai, $nilai)
    {
        return DB::table('tb_pengumpulan')
            ->where('id_nilai', $id_nilai)
            ->update(['nilai' => $nilai]);
    }
}
