<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table='PRESCRIPTION';

    protected $primaryKey='prescription_id';

    public $timestamps=false;

    protected $fillable=[
        'record_id',
        'medicine_name',
        'dosage',
        'frequency',
        'duration_days'
    ];

    public function record()
    {
        return $this->belongsTo(DentalRecord::class,'record_id');
    }
}