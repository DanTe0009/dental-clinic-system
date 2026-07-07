<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'PATIENT';

    protected $primaryKey = 'patient_id';

    public $timestamps = false;

    protected $fillable = [
        'patient_name',
        'age',
        'gender',
        'phone',
        'email',
        'street',
        'city',
        'state',
        'registration_date',
        'emergency_contact'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}