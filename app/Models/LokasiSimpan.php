<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiSimpan extends Model
{
    use HasFactory;

    protected $table = 'lokasi_simpan';

    protected $fillable = [
        'kolom',
        'rak',
        'bindeks',
        'map_bulan',
    ];

    public function arsip()
    {
        return $this->belongsToMany(Arsip::class, 'arsip_lokasi', 'id_lokasi', 'id_arsip');
    }
}
