<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $table = 'arsip';


    protected $fillable = [
        'jenis_arsip',         'nomor_urut_perbulan',  'nomor_dokumen', 'uraian_informasi', 'asal_surat', 'tanggal_surat',
'jumlah', 'tingkat_perkembangan',
        'keterangan',
    ];

    public function lokasiSimpan() {
        return $this->belongsTo(LokasiSimpan::class);
    }

    public function mediaArsip() {
        return $this->hasMany(MediaArsip::class);
    }



}
