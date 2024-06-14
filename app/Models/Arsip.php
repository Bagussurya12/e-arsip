<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $fillable = [
        'jenis_arsip', 'uraian_informasi', 'asal_surat', 'tanggal_surat',
        'nomor_urut_perbulan', 'nomor_dokumen', 'jumlah', 'tingkat_perkembangan',
        'keterangan',
    ];

    public function lokasiSimpan()
    {
        return $this->hasOne(LokasiSimpan::class);
    }

    public function mediaArsip()
    {
        return $this->hasOne(MediaArsip::class);
    }
}
