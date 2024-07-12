<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatSurat extends Model
{
    use HasFactory;
    protected $table = 'format_surat';
    protected $fillable = [
        'title',
        'file_surat',
    ];
}
