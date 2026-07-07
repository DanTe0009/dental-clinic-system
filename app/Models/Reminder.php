<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $table = 'REMINDER';

    protected $primaryKey = 'reminder_id';

    public $timestamps = false;

    protected $fillable = [
        'appointment_id',
        'reminder_date',
        'reminder_type',
        'reminder_status'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}