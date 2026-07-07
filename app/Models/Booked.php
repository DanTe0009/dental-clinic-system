<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booked extends Model
{
    protected $table='BOOKED';

    protected $primaryKey='appointment_id';

    public $timestamps=false;

    public $incrementing=false;

    protected $fillable=[
        'appointment_id',
        'confirmation_no',
        'booked_on'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
}