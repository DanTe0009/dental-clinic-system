<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    protected $table = 'DENTIST';

    protected $primaryKey = 'dentist_id';

    public $timestamps = false;

    protected $fillable = [
        'dentist_name',
        'phone',
        'email',
        'license_number',
        'years_experience'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'dentist_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'dentist_id');
    }

    public function specializations()
    {
        return $this->belongsToMany(
            Specialization::class,
            'DENTIST_SPECIALIZATION',
            'dentist_id',
            'specialization_id'
        );
    }
}