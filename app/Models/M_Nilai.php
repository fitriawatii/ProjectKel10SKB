<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_Nilai extends Model
{
    protected $table = 'tb_pengumpulan';
    protected $primaryKey = 'id_nilai';
    public $timestamps = false;

    public function getPengumpulanWithDetails()
    {
        return DB::table($this->table)
            ->join('tb_tugas', 'tb_pengumpulan.id_tugas', '=', 'tb_tugas.id_tugas')
            ->join('tb_siswa', 'tb_pengumpulan.nis', '=', 'tb_siswa.nis')
            ->select(
                'tb_pengumpulan.*',
                'tb_tugas.judul_tugas',
                'tb_tugas.tanggal_deadline',
                'tb_siswa.nama'
            )
            ->get();
    }

    public function updateNilai($id_nilai, $nilai)
    {
        return DB::table($this->table)
            ->where('id_nilai', $id_nilai)
            ->update(['nilai' => $nilai]);
    }
}
