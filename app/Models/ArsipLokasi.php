<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipLokasi extends Model
{
    use HasFactory;

    protected $table = 'arsip_lokasi';

    protected $fillable = [
        'id_arsip',
        'id_lokasi',
    ];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'id_arsip');
    }

    public function lokasi()
    {
        return $this->belongsTo(LokasiSimpan::class, 'id_lokasi');
    }
}
