<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table='INVOICE';

    protected $primaryKey='invoice_id';

    public $timestamps=false;

    protected $fillable=[
        'record_id',
        'generated_date',
        'due_date',
        'status'
    ];

    public function record()
    {
        return $this->belongsTo(DentalRecord::class,'record_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class,'invoice_id');
    }
}