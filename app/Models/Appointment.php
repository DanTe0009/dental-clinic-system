<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'APPOINTMENT';

    protected $primaryKey = 'appointment_id';

    public $timestamps = false;

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'appointment_date',
        'appointment_time',
        'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class,'dentist_id');
    }

    public function booked()
    {
        return $this->hasOne(Booked::class,'appointment_id');
    }

    public function cancelled()
    {
        return $this->hasOne(Cancelled::class,'appointment_id');
    }

    public function rescheduled()
    {
        return $this->hasOne(Rescheduled::class,'appointment_id');
    }
    public function dentalRecord()
{
    return $this->hasOne(DentalRecord::class,'appointment_id');
}
}