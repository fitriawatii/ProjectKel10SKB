<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class M_formulirprogram extends Model
{
    protected $table = 'tb_pendaftaran_program';
    protected $primaryKey = 'id_pendaftaran';
    public $timestamps = false;

    protected $fillable = [
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'dusun',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'no_hp',
        'email',
        'nama_ayah_wali',
        'nik_ayah_wali',
        'tahun_lahir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'nik_ibu',
        'tahun_lahir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'tinggi_badan',
        'berat_badan',
        'jarak_ke_skb',
        'waktu_tempuh_ke_skb',
        'anak_ke',
        'jumlah_saudara',
        'prestasi',
        'id_kelas',
        'id_paket'
    ];
}
