<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cancelled extends Model
{
    protected $table='CANCELLED';

    protected $primaryKey='appointment_id';

    public $timestamps=false;

    public $incrementing=false;

    protected $fillable=[
        'appointment_id',
        'cancellation_reason',
        'cancelled_on',
        'cancelled_by'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
}