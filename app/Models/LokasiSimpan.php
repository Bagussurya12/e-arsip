<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiSimpan extends Model
{
    use HasFactory;

    protected $fillable = ['arsip_id', 'kolom', 'rak', 'bindeks', 'map_bulan'];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class);
    }
}