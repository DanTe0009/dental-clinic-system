<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentistSpecialization extends Model
{
    protected $table = 'DENTIST_SPECIALIZATION';

    public $timestamps = false;

    protected $fillable = [
        'dentist_id',
        'specialization_id'
    ];
}