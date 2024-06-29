<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

    protected $table = 'undangan';
    
    protected $fillable = [
        'arsip_id', 
        'disposisi_acara', 
        'notulen', 
        'foto_kegiatan', 
        'keterangan_undangan'
    ];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'arsip_id');
    }
}
