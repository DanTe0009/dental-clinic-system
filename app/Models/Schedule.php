<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'SCHEDULE';
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;

    protected $fillable = [
        'dentist_id',
        'available_date',
        'start_time',
        'end_time',
        'is_available'
    ];

    public function dentist()
    {
        return $this->belongsTo(Dentist::class,'dentist_id');
    }
}