<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terusan extends Model
{
    protected $table = 'terusan';
    protected $fillable = [
        'value',
    ];
}
