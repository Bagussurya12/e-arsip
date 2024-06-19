<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiSimpan extends Model
{
    use HasFactory;
    // protected $table = 'arsip';
    protected $table = 'lokasi_simpan';
    protected $fillable = ['arsip_id', 'kolom_lemari',  'no_bindeks', 'map_bulan','tahun'];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'arsip_id');
    }
}