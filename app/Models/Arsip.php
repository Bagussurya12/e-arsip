<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsip';


    protected $fillable = [
        'jenis_arsip','nomor_urut_perbulan', 'nomor_dokumen', 'uraian_informasi', 'asal_surat', 'tanggal_surat',
        'jumlah', 'tingkat_perkembangan',
        'keterangan', 'jenis_media', 'media', 
    ];

    public function lokasiSimpan()
    {
        return $this->hasOne(LokasiSimpan::class, 'arsip_id');
    }
}
