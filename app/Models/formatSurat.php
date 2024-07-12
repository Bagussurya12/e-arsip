<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formatSurat extends Model
{
    use HasFactory;

    protected $table = 'formatSurat';

    protected $fillable = [
        'title',
        'file_surat'
    ];
}
