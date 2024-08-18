<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDinas extends Model
{
    // Nama tabel yang digunakan oleh model ini
    protected $table = 'nota_dinas';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'arsip_id',
        'nomor_dokumen',
        'tanggal',
        'perihal',
        'kepada',
        'dari',
        'isi',
        'tembusan',
        'foto'
    ];

    // Tipe kolom yang perlu dikonversi ke tipe data tertentu
    protected $casts = [
        'tanggal' => 'date',
    ];

}
