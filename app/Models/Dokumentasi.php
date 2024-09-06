<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dokumentasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'procurement_id',
        'user_id',
        'title',
        'tanggal',
        'deskripsi',
        'foto',
    ];

    /**
     * Relasi ke model Procurement.
     * Dokumentasi terkait dengan satu procurement.
     */
    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }

    /**
     * Relasi ke model User.
     * Dokumentasi dibuat oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
