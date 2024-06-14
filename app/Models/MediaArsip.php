<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaArsip extends Model
{
    protected $fillable = ['jenis_media', 'nama_media'];

    public function arsip()
    {
        return $this->belongsTo(Arsip::class);
    }
}
