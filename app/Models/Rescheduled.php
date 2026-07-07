<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rescheduled extends Model
{
    protected $table='RESCHEDULED';

    protected $primaryKey='appointment_id';

    public $timestamps=false;

    public $incrementing=false;

    protected $fillable=[
        'appointment_id',
        'original_date',
        'original_time',
        'reschedule_reason',
        'rescheduled_on'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
}