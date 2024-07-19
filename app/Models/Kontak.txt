<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;
    protected $table = 'kontak';
    // Tentukan kolom-kolom yang bisa diisi
    protected $fillable = [
        'name',
        'email',
        'phone',
        'institution',
        'message',
    ];
}
