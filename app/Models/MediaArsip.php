<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaArsip extends Model
{
    use HasFactory;

    protected $table = 'media_arsip';

    protected $fillable = [
        'id_arsip',
        'jenis_media',
        'nama_media',
    ];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'id_arsip');
    }
}
