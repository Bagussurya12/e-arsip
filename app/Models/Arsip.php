<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsip';


    protected $fillable = [
        'keterangan',
        'jenis_surat',
        'asal_surat', 'tanggal', 'bulan', 'tahun', 'uraian_informasi', 'nomor_urut_perbulan',
        'nomor_dokumen', 'jumlah', 'tingkat_perkembangan', 'disposisi', 'terusan', 'jenis_media', 'media',
    ];

    public function lokasiSimpan()
    {
        return $this->hasOne(LokasiSimpan::class, 'arsip_id');
    }
}
