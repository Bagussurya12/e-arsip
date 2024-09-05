<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'procurements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'tanggal',
        'bulan',
        'tahun',
        'division',
        'procurement_number',
        'status',
        'remarks',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'integer',
        'tahun' => 'integer',
    ];

    /**
     * Get the status of the procurement.
     *
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Set the procurement number to uppercase.
     *
     * @param string $value
     * @return void
     */
    public function setProcurementNumberAttribute($value)
    {
        $this->attributes['procurement_number'] = strtoupper($value);
    }
}
