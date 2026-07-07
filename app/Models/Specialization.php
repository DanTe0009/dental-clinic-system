<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'SPECIALIZATION';
    protected $primaryKey = 'specialization_id';
    public $timestamps = false;

    protected $fillable = [
        'specialization_name',
        'description'
    ];

    public function dentists()
    {
        return $this->belongsToMany(
            Dentist::class,
            'DENTIST_SPECIALIZATION',
            'specialization_id',
            'dentist_id'
        );
    }
}