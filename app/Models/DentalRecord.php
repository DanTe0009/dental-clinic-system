<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentalRecord extends Model
{
    protected $table='DENTAL_RECORD';

    protected $primaryKey='record_id';

    public $timestamps=false;

    protected $fillable=[
        'appointment_id',
        'created_date',
        'allergies',
        'medical_history'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class,'record_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class,'record_id');
    }

    public function xrays()
    {
        return $this->hasMany(Xray::class,'record_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class,'record_id');
    }
}