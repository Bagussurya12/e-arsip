<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arsip';

    protected $fillable = [
        'jenis_arsip',
        'uraian_informasi',
        'asal_surat',
        'tanggal_surat',
        'nomor_urut_perbulan',
        'nomor_dokumen',
        'jumlah',
        'tingkat_perkembangan',
        'keterangan',
    ];

    public function lokasi()
    {
        return $this->belongsToMany(LokasiSimpan::class, 'arsip_lokasi', 'id_arsip', 'id_lokasi');
    }

    public function media()
    {
        return $this->hasMany(MediaArsip::class, 'id_arsip');
    }
}
